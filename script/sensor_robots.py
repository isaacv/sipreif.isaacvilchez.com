import random
from random import randint
import serial       # import Serial Library
import urllib
import smtplib
from email.MIMEMultipart import MIMEMultipart
from email.MIMEText import MIMEText

# Declaring variables
sensorid=[112,212,312]
sensors=['111','211','311','112','212','312']

basetemp=92
basehum=30
basesmoke=250
print(basetemp)
salert_count=0
talert_count=0

# Serial Conn
arduinoData = serial.Serial('/dev/cu.usbmodem14101', 9600) #Creating our serial object named arduinoData

# Data received by Serial
sid = []       #ID de la mota
temp = []        #Convertir valor de temp a Float
hum = []          #Convertir valor de humedad a Float
smokeVar = []    #Valor de sensor de Humo

# FUNCION PARA ENVIO DE CORREOS
def email(subject):
	fromaddr = "isaac.vilchez91@gmail.com"
	toaddr = "salerts@isaacvilchez.com"
	msg = MIMEMultipart()
	msg['From'] = fromaddr
	msg['To'] = toaddr
	msg['Subject'] = subject

	body = "Uno de los sensores esta generando una alerta"
	msg.attach(MIMEText(body, 'plain'))

	server = smtplib.SMTP('smtp.gmail.com', 587)
	server.starttls()
	server.login(fromaddr, "Hykhoz-fohcy5-qakfup")
	text = msg.as_string()
	server.sendmail(fromaddr, toaddr, text)
	#server.quit()

def populateVar(dataArray):
	sid.append(int(dataArray[0]))          #ID de la mota
	temp.append(float(dataArray[1]))     #Convertir valor de temp a Float
	hum.append(float(dataArray[2]))     #Convertir valor de humedad a Float
	smokeVar.append(float(dataArray[3])) #Valor de sensor de Humo

	# Defining base for robots
	basetemp = float(dataArray[1])
	basehum	= float(dataArray[2])
	basesmoke = float(dataArray[3])

def robots(basetemp,basehum,basesmoke):
	for id in sensorid:
		tempd=round(random.uniform(-10,10),2)
		humd=randint(-5,5)
		smoked=randint(-50,50)
		reftemp=basetemp+tempd
		refhum=basehum+humd
		refsmoke=basesmoke+smoked
		sid.append(id)
		temp.append(reftemp)
		hum.append(refhum)
		smokeVar.append(refsmoke)

def publish(sid,temp,hum,smokeVar):
	global talert_count
	global salert_count
	for i in range(len(sid)):
		refsid=sid[i]
		reftemp=temp[i]
		refhum=hum[i]
		refsmoke=smokeVar[i]
		if reftemp > 100:
			tempFlag=1
			subject="ALERT: temp_alert in sensor "+str(refsid)
			print(subject)
			if talert_count == 5:
				email(subject)
				print('message sent')
				talert_count=0
			else:
				talert_count+=1
		else:
			tempFlag=0
		if refsmoke > 300:
			smokeFlag=1
			salert_count=1
			subject="ALERT: smoke_alert in sensor "+str(refsid)
			print(subject)
			if salert_count== 1:
				email(subject)
				print('message sent')
				salert_count=0
			else:
				salert_count += 1
				print('salert_count='+str(salert_count))
		else:
			smokeFlag=0
		url="http://sipreif.isaacvilchez.com/uat/api/var-insert.php?id="+str(refsid)+"&temp="+str(reftemp)+"&hum="+str(refhum)+"&smokeVar="+str(refsmoke)+"&tempFlag="+str(tempFlag)+"&smokeFlag="+str(smokeFlag)
		print url
		urllib.urlopen(url)



# FUNCION PRINCIPAL
subject="Task has started"
email(subject)

while True: # While loop that loops forever
	while (arduinoData.inWaiting()==0):         #Wait here until there is data
		pass #do nothing
	arduinoString = arduinoData.readline()      #read the line of text from the serial port
	dataArray =     arduinoString.split(',')    #Split it into an array called dataArray
	dataArrayTemp = dataArray

	print dataArray
	sensor=dataArray[0]
	if sensor in sensors:
		populateVar(dataArray)
		robots(basetemp,basehum,basesmoke)
		publish(sid,temp,hum,smokeVar)
	#
	# if dataArrayTemp[0]=='411':
	# 	populateVar(dataArrayTemp)
	# 	#robots(basetemp,basehum,basesmoke)
	# 	publish(sid,temp,hum,smokeVar)
	# 	sid = []       #ID de la mota
	# 	temp = []        #Convertir valor de temp a Float
	# 	hum = []          #Convertir valor de humedad a Float
	# 	smokeVar = []

	#publish(sid,temp,hum,smokeVar)
		# print sid
		# print temp
		# print hum
		# print smokeVar
	# 	basetemp=temp
	# 	url = "http://sipreif.isaacvilchez.com/boscosas-insert?id="+str(ident)+"&temp="+str(temp)+"&hum="+str(H)+"&smokeVar="+str(smokeVar)+"&tempFlag="+str(tempFlag)+"&smokeFlag="+str(smokeFlag)
	# 	urllib.urlopen(url)
