<html>
<header>
</header>
<body>
<h1>
    Kedves felhasználó,
</h1>
<p>
    Regisztráció elkezdése érdekében kattintson
    <a href="{{env("SSO_HOST")."/register?invitationToken=".$invitationToken."&encoding=".$encoding."&details=".$details."&client=".env("APP_URL")}}">ide</a>!
    Ha nem igényelte vagy nem szeretne regisztrálni kérjük hagyja figyelmen kívül ezt az üzenetet!
    Az E-mail automatikusan generált nem kell rá válaszolni!
    Köszönjük!
</p>
</body>
</html>
