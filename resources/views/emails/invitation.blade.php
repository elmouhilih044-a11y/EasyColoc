<h2>Bonjour !</h2>
<p>Vous avez été invité par <strong>{{ $invitation->invitedBy->name }}</strong> à rejoindre sa colocation sur ColocManager.</p>

<div style="margin: 30px 0;">
    <a href="{{ route('invitations.show', $invitation->token) }}" 
       style="background-color: #B85C38; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold;">
        Voir l'invitation
    </a>
</div>

<p>Si vous n'attendiez pas cette invitation, vous pouvez ignorer cet email.</p>