<h1>Hi {{ $name }},</h1>

<p>Please activate your account by copying and pasting the following activation code:</p>

<h2 style="color:#3490dc;">Activation Code: {{ $activation_code }}</h2>

<p>Or click the link below to confirm your account:</p>

<a href="{{ route('app_activation_account_link', ['token' => $activation_token]) }}" style="color:#1a73e8; text-decoration: none;" target="_blank">Confirm your account</a>

<p>GCT team.</p>
