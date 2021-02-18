<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Demystifying Email Design</title>
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
            <td align="center" style="color: #1D99BF; font-weight: 700; text-transform: uppercase; word-spacing: 2px; font-size: 18px; padding: 18px 0 18px 0;">Confirmación de pedido</td>
          </tr>
          
          <tr>
            <td align="center" style="color: #EF597D; font-size: 15px; line-height: 24px; padding: 15px 0 15px 0;">
              
              <b>Pedido:</b> {{ $pedido->id }}<br/>
              
              <b>Realizado por:</b> {{ $pedido->pedido_nombre }} <br/>
              
              <b>Fecha:</b> {{ $pedido->created_at->format('d-F-Y H:i') }} <br/>
              
              <b>E-mail:</b> {{ $pedido->pedido_email }} <br/>
              
            </td>
          </tr>

          @php
            $direccion = $pedido->paquetes->where('entregable',  '=', 1)->first();
          @endphp
                  
          <tr>
            <td align="center" style="color: #EF597D; font-size: 14px; line-height: 24px; padding: 15px 10px 15px 10px;">Su pedido será enviado por paqueteria dentro de un lapso de 10 días a la dirección que indicó.</td>
          </tr>

          <tr>
            <td align="center" style="color: #EF597D; font-size: 14px; line-height: 24px; padding: 15px 25px 15px 25px;">{{ $direccion->pivot->pedido_ciudad.", ".$direccion->pivot->pedido_estado.", C.P. ".$direccion->pivot->pedido_codigo_postal.", Col. ".$direccion->pivot->pedido_colonia.", ".$direccion->pivot->pedido_direccion }}</td>
          </tr>
          
          <tr>
            <td align="center" style="color: #1D99BF; font-size: 16px; font-weight: 700; text-transform: uppercase; line-height: 24px; padding: 15px 10px 6px 10px;">Productos que adquirió</td>
          </tr>
          
          <tr>
            <td style="padding: 25px 15px 25px 15px;">
              
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                
                <tr>
                  <th style="border: solid 1px #8BBC3C; color: #1D99BF; font-size: 13px; line-height: 15px; padding: 6px 8px 6px 8px;" align="center" width="50%" valing="top">Producto</th>
                  <th style="border: solid 1px #8BBC3C; color: #1D99BF; font-size: 13px; line-height: 15px; padding: 6px 8px 6px 8px;" align="center" width="20%" valing="top">Cantidad</th>
                  <th style="border: solid 1px #8BBC3C; color: #1D99BF; font-size: 13px; line-height: 15px; padding: 6px 8px 6px 8px;" align="center" width="50%" valing="top">Medida</th>
                  <th style="border: solid 1px #8BBC3C; color: #1D99BF; font-size: 13px; line-height: 15px; padding: 6px 8px 6px 8px;" align="center" width="50%" valing="top">Base</th>
                  <th style="border: solid 1px #8BBC3C; color: #1D99BF; font-size: 13px; line-height: 15px; padding: 6px 8px 6px 8px;" align="center" width="50%" valing="top">Descripción</th>
                </tr>

                @foreach ($pedido->paquetes as $paquete)
                <tr>
                  <td style="border: solid 1px #8BBC3C; color: #EF597D; font-size: 13px; font-weight: 700; line-height: 15px; padding: 6px 8px 6px 8px;" align="center" width="50%" valing="top">{{ $paquete->nombre }}</td>
                  <td style="border: solid 1px #8BBC3C; color: #EF597D; font-size: 13px; font-weight: 700; line-height: 15px; padding: 6px 8px 6px 8px;" align="center" width="20%" valing="top">{{ $paquete->pivot->cantidad }}</td>
                  <td style="border: solid 1px #8BBC3C; color: #EF597D; font-size: 13px; font-weight: 700; line-height: 15px; padding: 6px 8px 6px 8px;" align="center" width="50%" valing="top">{{ $paquete->pivot->medida }}</td>
                  <td style="border: solid 1px #8BBC3C; color: #EF597D; font-size: 13px; font-weight: 700; line-height: 15px; padding: 6px 8px 6px 8px;" align="center" width="50%" valing="top">{{ $paquete->pivot->base }}</td>
                  <td style="border: solid 1px #8BBC3C; color: #EF597D; font-size: 13px; line-height: 15px; padding: 6px 8px 6px 8px;" align="center" width="50%" valing="top">{{ $paquete->descripcion }}</td>
                </tr>
                @endforeach
                
              </table>
              
            </td>
          </tr>
          
          <tr>
            
            <td align="center" style="color: #1D99BF; font-weight: 700; text-transform: uppercase; word-spacing: 2px; font-size: 18px; padding: 18px 0 5px 0;">Total</td>
            
          </tr>
          
          <tr>
            
            <td align="center" style="color: #EF597D; font-size: 15px; line-height: 26px; padding: 15px 0 20px 0;">
              
              <b>Subtotal:</b> ${{ $pedido->pedido_subtotal }} <br/>
              
              <b>Impuestos:</b> ${{ $pedido->pedido_tax }} <br/>
              
              <b>Total:</b> ${{ $pedido->pedido_total }} <br/>
              
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

