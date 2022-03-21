#Instrucciones

#IF
''' las 3 comillas se usan para encerrar un bloque de comentarios

if 2 < 5:
    print('2 es menor que 5')

a= 2
b = 2
if a == b:
    print("Las variables tienen el mismo valor")

if 3 == 4:
    print("Los numeros 3 y 4 son iguales")

if 2 > 5:
    print("2 es mayor a 5")

if 5 != 4:
    print("5 es distinto de 4")

if 3 >= 2:
    print("3 es mayor o igual 2")

if 1 <= 1:
    print("1 es menor igual a 1")

'''
if 2 > 2:
    print("2 es mayor que 5")
elif 2 < 2:
    print("2 es menor a 5")
else:
    print("los numeros son iguales")

#IF CORTOS Y TERNARIOS

if 5 > 3: print("if corto de una linea")

print("cuando devuelve true") if 5 > 2 else print("cuando devuelve false") #Operador ternario

#AND Y OR

if 5 < 4 and 10 < 20: 
    print("se cumplen las 2 condiciones")
elif 4 > 6 or 3 < 5:
    print("Se cumple una condicion en elif") 
