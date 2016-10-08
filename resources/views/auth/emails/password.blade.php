<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body style="font-family: arial, sans-serif;">
		<h2 style=" color: #dd0330;font-size: 20px;font-weight: 300;letter-spacing: 0;line-height: 30px;">
            Droit du
            <strong style="color: #5a101f;">travail</strong>.ch
        </h2>

		<div style="font-family: arial, sans-serif;">
            <h3 style="font-family: arial, sans-serif;">Demande de mise à jour du mot de passe sur www.droitdutravail.ch</h3>

            <p style="font-family: arial, sans-serif;">Bonjour, <br/>
                Cet email vous a été envoyé suite à votre demande de réinitialisation de mot de passe. Veuillez cliquer sur le lien ci-dessous.
            </p>
            <p style="font-family: arial, sans-serif;">
            <a style="text-align:center;font-size:13px;font-family:arial,sans-serif;
			color:white;font-weight:bold;background-color: #dd0330;border: 1px solid #cc002a;
			text-decoration:none;display:inline-block;min-height:27px;padding-left:8px;padding-right:8px;
			line-height:27px;border-radius:2px;border-width:1px" href="{{ URL::to('password/reset', array($token)) }}">Réinitialiser le mot de passe </a></p>
            <p style="font-family: arial, sans-serif;">Pour des raisons de sécurité, ce lien n'est valide que pendant {{ Config::get('auth.reminder.expire', 60) }} minutes.
            <br/>Si vous ne cliquez pas sur ce lien avant ce délai, vous devrez recommencer la procédure de réinitialisation de mot de passe.</p>
            <p><a style="font-size:11px;color:#9a9a9a;" href="{{ url('/') }}">Droit du travail.ch</a></p>

		</div>

	</body>
</html>
