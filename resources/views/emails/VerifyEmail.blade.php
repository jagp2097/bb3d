<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Bb3D Email</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
</head>
<body style="padding: 0; margin: 0;">
  
  <table align="center" border="0" width="600" cellpadding="0" cellspacing="0" style="color: #f2f5f8; border-collapse: collapse;">
    
    <tr>
      <td align="center" bgcolor="#f2f5f8" style="padding: 10px 0 10px 0;">
        <img src="{{ asset('images/pagina/email-logo.png') }}" alt="bb3d_logo" width="175"/>
      </td>
      
    </tr>
    
    <tr>
      
      <td align="center" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif; padding:25px;">
        
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
          
          <tr>
            <td align="center" style="color: #1D99BF; font-weight: 700; text-transform: uppercase; word-spacing: 2px; font-size: 18px; padding: 18px 0 18px 0;">Verificación de correo electrónico</td>
          </tr>
          
          <tr>
            <td align="center" style="color: #EF597D; font-size: 14px; line-height: 24px; padding: 15px 10px 15px 10px;">Por favor da click en el siguiente botón para verificar tu dirección de correo electrónico.</td>
          </tr>
          
          <tr>
            <td align="center" style="color: #EF597D; font-size: 14px; line-height: 24px; padding: 15px 25px 15px 25px;">
                <a style="background: #8BBC3C; text-decoration: none; font-size: .875rem; border: 0; border-radius: 3px; padding: .4rem .6rem; margin: .1rem; color: #fff;" href="{{ $url }}">Verificar correo electrónico</a>                    
            </td>
          </tr>
          
          <tr>
            <td align="center" style="color: #EF597D; font-size: 14px; line-height: 24px; padding: 15px 10px 15px 10px;">
                Si tu no creaste una cuenta, haga caso omiso a este mensaje.
            </td>
          </tr>
                    
          <tr>
            <td align="right" style="color: #EF597D; font-size: 14px; line-height: 15px; padding: 15px 12px 15px 12px;">Saludos, equipo de Bb3d.</td>
          </tr>

          <tr>

            <td style="color: #EF597D; font-size: 12px; line-height: 20px; padding: 15px 12px 0 12px;" align="center" >
                Si estas teniendo problemas al dar click sobre el botón "Verificar correo electrónico", 
                  copia y pega la siguiente URL en tu navegador: <br/>
                <a style="text-decoration: none;" href="{{ $url }}" target="_blank">
                  <font color="#EF597D">{{ $url }}</font>
                </a>
            </td>
      
          </tr>
          
        </table>
        
        
      </td>
      
    </tr>

    <tr>
      
      <td align="center" bgcolor="#f2f5f8"  style="font-family: 'Montserrat', sans-serif; word-spacing: 2px; padding: 15px 12px 15px 12px;">
        

        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          
          <tr>
            
            <td style="color: #EF597D; font-size: 12px; line-height: 20px; padding: 15px 12px 15px 12px;" align="center" width="50%" valing="top">
              
            </td>
            
            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
            
            <td style="color: #EF597D; font-size: 12px; line-height: 20px; padding: 15px 12px 15px 12px;" align="center" width="50%" valing="top">
              
            </td>
            
          </tr>
          
        </table>
        
      </td>
      
    </tr>
    
    <tr>
      
      <td align="center" bgcolor="#f2f5f8"  style="color: #EF597D; font-size: 11px; line-height: 15px; font-family: 'Montserrat', sans-serif; word-spacing: 2px; padding: 25px 15px 25px 15px;">
        
        
      </td>
      
    </tr>
    
  </table>
  
</body>
</html>