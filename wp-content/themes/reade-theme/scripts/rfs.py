import pyperclip

def doItForMe(
   fl=90 ,
   fs=32 , 
   sl=1400 ,
   ss=576 ,
   prop ='font-size'
):
   e = (fl - fs) / (sl - ss)
   b = fl - (e * sl)# / 100)
   vw = e * 100
   fin = f"@include clamp({prop}, {fs}px, calc({vw}vw + {b}px), {fl}px);"
   # print(e, b, vw)
   # print()
   # print(fin)
   pyperclip.copy(fin)
   val = pyperclip.paste()
   return
doItForMe(
   # prop = 'border-radius'
   prop = 'margin-top'
   # prop = 'margin-bottom'
   # prop = 'padding-left'
   # prop = 'padding-right'
   # prop = 'padding-top'
   # prop = 'padding-bottom'
   # prop = 'width'
)