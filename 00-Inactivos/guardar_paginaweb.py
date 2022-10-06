#!/usr/bin/env python
from urllib.request import urlopen
import urllib
import ssl
import mysql.connector
context = ssl._create_unverified_context()
conexion1=mysql.connector.connect(host="localhost", user="root", passwd="", database="travian")
cursor1=conexion1.cursor()
cursor1.execute("select ruta_inac,nombre,id from servidor")
informacion = list()

for base in cursor1:
    id_server=base[2]
	
    print(base[1])
    url = base[0]
    nombre_fichero="map"+ base[1]+".sql"
    nombre_fichero =nombre_fichero.replace(' ','_')
   
    r = urlopen(url, context=context)
    with open(nombre_fichero, "wb") as f:
        f.write(r.read())
    r.close()
    # Nombre con el que quiero descargar el archivo.
    f = open(nombre_fichero, "r",errors="replace")
    while(True):
        linea = f.readline()
        linea = linea.replace("'",'')
        linea = str(linea).replace("'",'')
        if not linea:
            break
        try:
            informacion=linea.split(',')
            coord_x=informacion[1]
            coord_y=informacion[2]
            id_raza=informacion[3]
            id_aldea=informacion[4]
            nombre_aldea=informacion[5].replace(';','')
            id_cuenta=informacion[6]
            nombre_cuenta=informacion[7].replace(';','')
            id_alianza=informacion[8]
            nombre_alianza=informacion[9].replace(';','')
            poblacion=informacion[10]
            #ALIANZAS
            cursor2=conexion1.cursor()
            #print(id_alianza)
            strQuery="select count(*) from alianza_inac where idAlianza="+id_alianza
            cursor2.execute(strQuery)
            
            for base2 in cursor2:
                contador=base2[0]
                contador2=1
            if contador==0:
                contador2=2
                #Insertar nueva alianza
                strQuery="Insert into alianza_inac (idAlianza,NombreAlianza,created_at,updated_at) VALUES ("+id_alianza+",'"+ nombre_alianza +"',CURDATE(),CURDATE())"
                print(strQuery)
                cursor2.execute(strQuery)
            else:
                strQuery="UPDATE alianza_inac SET NombreAlianza='"+nombre_alianza+"',updated_at=CURRENT_DATE() WHERE idAlianza = "+id_alianza
                cursor2.execute(strQuery)
            #meter else por si modifica el nombre de la alianza      
            #CUENTAS
            cursor2=conexion1.cursor()
            #print(id_cuenta)
            strQuery="select count(*) from cuenta_inac where idCuenta="+id_cuenta
            cursor2.execute(strQuery)
            for base2 in cursor2:
                contador=base2[0]
            if contador==0:
                #Insertar nueva alianza 
                    strQuery="INSERT INTO cuenta_inac(IdCuenta,IdServer,IdAlianza,NombreCuenta,Raza,Activo,created_at,supend_at, modif_at) VALUES ("+str(id_cuenta)+","+str(id_server)+","+str(id_alianza)+",'"+ nombre_cuenta+"',"+str(id_raza)+",'1',CURDATE(),NULL,CURDATE())"
                    #print(strQuery)
                    cursor2.execute(strQuery)  
            #ALDEAS  
                #Insertar nueva alianza 
            strQuery="INSERT INTO aldea_inac(IdAldea,NombreAldea,coord_x,coord_y,poblacion,created_at,updated_at,IdCuenta) VALUES ("+id_aldea+",'"+nombre_aldea+"',"+coord_x+","+coord_y+","+poblacion+",CURDATE(),CURDATE(),"+str(id_cuenta)+")"
            #print(strQuery)
            cursor2.execute(strQuery)
        except: 
           #print(contador2)
           contador2 = contador2
    f.close()
strQuery="UPDATE servidor SET fch_mod=CURDATE() WHERE id ="+str(id_server)
cursor1.execute(strQuery)

conexion1.commit()   
#print("commit")    
conexion1.close() 

