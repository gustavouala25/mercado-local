<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background-color: #4f46e5; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; }
        .content { padding: 30px; color: #374151; line-height: 1.6; }
        .button { display: inline-block; background-color: #4f46e5; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 20px; }
        .footer { background-color: #f9fafb; padding: 20px; text-align: center; font-size: 12px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Bienvenido a Mercado Local!</h1>
        </div>
        <div class="content">
            <h2>Hola, {{ $vendor->name }} 👋</h2>
            <p>Estamos muy emocionados de tenerte con nosotros. Tu comercio ha sido registrado exitosamente en nuestra plataforma.</p>
            <p>Ahora puedes comenzar a publicar tus productos y llegar a más clientes en tu comunidad.</p>
            <div style="text-align: center;">
                <a href="{{ route('dashboard') }}" class="button">Ir a mi Panel</a>
            </div>
            <p>Si tienes alguna duda, estamos aquí para ayudarte.</p>
            <p>¡Mucho éxito en tus ventas!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Mercado Local. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
