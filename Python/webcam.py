#Import de bibliotecas
import cv2
import requests
import _thread
from time import strftime
import sys

#Criação de um objeto que permite captar a foto

#função para obter a data e hora
def datahora():
    return strftime("%d/%m/%Y %H:%M:%S")

#Função que permite enviar dados para API
def send_to_api(dados):
    r = requests.post("http://127.0.0.1/ProjetoTI/api/api.php", data = dados)

    if r.status_code==200: #Código Status HTTP --> OK (Sucesso)
        print ("OK: POST realizado com sucesso")
        print (r.status_code)
    else:
        print ("ERRO: Não foi possível realizar o pedido")
        print (r.status_code)

#Função que envia a foto 
def send_file(files):
    url = 'http://127.0.0.1/ProjetoTI/upload.php'
    
    r = requests.post(url, files=files)
    print(str(r.status_code) + " " + r.text)



#Código que permite a tiragem da foto
try:
    
    count = 0
    
    while True:
        r=requests.get('http://127.0.0.1/ProjetoTI/api/api.php?nome=webcam', timeout=2.00)
        if (r.status_code == 200):
            
            if r.text == "1":
                
                cam = cv2.VideoCapture(0)
                ret, image = cam.read()

                print("A tirar fotografia!!\n")
                
                cv2.imwrite('webcam.jpg',image)

                #colocação de dados e da foto em arrays
                #files = {'imagem': open('webcam.jpg', 'rb')}
                files = {'imagem':  ('webcam.jpg', open('webcam.jpg', 'rb'), 'image/jpeg')}

                dados = {'nome': 'webcam','valor': "0" ,'hora': datahora()}
                
              
                send_file(files)
                send_to_api(dados)
                    
                #Libertação da câmera e destruição das janelas
                cam.release()
                cv2.destroyAllWindows()
                
                #count = 1
            
        else:
            print ("O pedido HTTP não foi bem sucedido")
            
        #if count == 1:
            #break

except:
    print("Ocorreu um erro" , sys.exc_info())
    

finally:
    print("Fim do Programa")
 