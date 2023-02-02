#Import de bibliotecas
import sys
import time
import requests
import winsound


def play_sound(SND_FILENAME):
    play_obj = winsound.PlaySound(SND_FILENAME, winsound.SND_FILENAME)
    winsound.SND_NOSTOP

try :
     print( "Prima CTRL+C para terminar")
     while True: # ciclo para o programa executar sem parar…
          r=requests.get('http://127.0.0.1/ProjetoTI/api/api.php?nome=ondas') #Pedido GET para obter o valor do sensor de incendio
        
          if r.status_code==200: #sucesso no pedido
                print( "Altura das Ondas " + r.text ) #Escrita do valor recebido
                if (float(r.text) >= 20.0):
                    print( "Altura das Ondas " + r.text )
                    play_sound("alarme.wav") #Comando que permite a reprodução do som de alarme
          else:
               print("O pedido HTTP não foi bem sucedido")
               
          time.sleep (2)

except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
     print( "Programa terminado pelo utilizador")

except : # caso haja um erro qualquer
     print( "Ocorreu um erro:", sys.exc_info() )

finally : # executa sempre, independentemente se ocorreu exception
     print( "Fim do programa") 
