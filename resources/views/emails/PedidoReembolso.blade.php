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
            <td align="center" style="color: #1D99BF; font-weight: 700; text-transform: uppercase; word-spacing: 2px; font-size: 18px; padding: 18px 0 18px 0;">Reembolso del pedido</td>
          </tr>

          <tr>
            <td align="center" style="color: #EF597D; font-size: 15px; line-height: 26px; padding: 15px 0 20px 0;">
                Lo sentimos, no hemos podido completar su pedido.
            </td>
          </tr>
          
          <tr>
            <td align="center" style="color: #EF597D; font-size: 15px; line-height: 24px; padding: 15px 0 15px 0;">
              
              <b>Pedido:</b> {{ $pedido->id }}<br/>
              
              <b>Realizado por:</b> {{ $pedido->pedido_nombre }} <br/>
              
              <b>Fecha:</b> {{ $pedido->created_at->format('d-F-Y H:i') }} <br/>
              
              <b>E-mail:</b> {{ $pedido->pedido_email }} <br/>

              <b>Cantidad reembolsada:</b> ${{ $refundData['amount'] }} <br/>
              
            </td>
          </tr>
          
          <tr>
            <td align="center" style="color: #1D99BF; font-size: 16px; font-weight: 700; text-transform: uppercase; line-height: 24px; padding: 15px 10px 6px 10px;">Causa del reembolso</td>
          </tr>
                    
          <tr>
            
            <td align="center" style="color: #EF597D; font-size: 15px; line-height: 26px; padding: 15px 0 20px 0;">
              
              {{ $refundData['description'] }}
              
            </td>
            
          </tr>

          <tr>
            <td align="center" style="color: #EF597D; font-size: 15px; line-height: 26px; padding: 15px 0 20px 0;">
                El reembolso esta siendo procesado, en unos días obtendrá el dinero de regreso a su cuenta.
            </td>
          </tr>
          
          <tr>
            
            <td align="right" style="color: #EF597D; font-size: 14px; line-height: 15px; padding: 15px 12px 15px 12px;">Saludos, equipo de Bb3d.</td>
            
          </tr>
          
        </table>
        
        
      </td>
      
    </tr>
    
    <tr>
      
      <td align="center" bgcolor="#f2f5f8"  style="font-family: 'Montserrat', sans-serif; word-spacing: 2px; padding: 15px 12px 15px 12px;">
        
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          
          <tr>
            
            <td style="color: #EF597D; font-size: 12px; line-height: 20px; padding: 15px 12px 15px 12px;" align="center" width="50%" valing="top">
              Guadalajara 910, Mitras Sur, Monterrey, Nuevo León C.P: 64020 <br/>
              <font color="#EF597D">contacto@bb3d.mx</font>  <br/>
              +52 01 81 2721 3864 <br/>
            </td>
            
            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
            
            <td style="color: #EF597D; font-size: 12px; line-height: 20px; padding: 15px 12px 15px 12px;" align="center" width="50%" valing="top">
              
              
              <a style="text-decoration: none;" href="https://www.facebook.com/bebe3dmx/" target="_blank">
                
                <img style="width: 20px; vertical-align: middle;" src="{{ asset('images/pagina/svg/logo-facebook.svg') }}" alt=""/>
                
                <font color="#EF597D">bebe3dmx/</font> 
                
              </a>
              
              <br/>
              
              <a style="text-decoration: none;" href="https://www.instagram.com/bb3d_mx/" target="_blank">
                
                <img style="width: 20px; vertical-align: middle; margin-left: -7px; fill: #EF597D;" src="{{ asset('images/pagina/svg/logo-instagram.svg') }}" alt=""/>
                <font color="#EF597D">bb3d_mx/</font> 
                
              </a>
              
            </td>
            
          </tr>
          
        </table>
        
      </td>
      
    </tr>
    
    <tr>
      
      <td align="center" bgcolor="#f2f5f8"  style="color: #EF597D; font-size: 11px; line-height: 15px; font-family: 'Montserrat', sans-serif; word-spacing: 2px; padding: 25px 15px 25px 15px;">
        
        Copyright © 2019 by Master Deploy. All rights reserved. <br/>
        
      </td>
      
    </tr>
    
  </table>
  
</body>
</html>
















