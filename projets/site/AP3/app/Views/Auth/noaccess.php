<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>No Access — Accès refusé</title>
  <link rel="stylesheet" href="<?= base_url('CSS/NoAccess.css') ?>">
</head>
<body>
  <main role="main" aria-labelledby="title" class="card">
    <div class="glyph" aria-hidden="true">
      <!-- lock / no access icon -->
      <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
        <rect x="2" y="10" width="20" height="11" rx="2" stroke="currentColor" stroke-width="1.2" opacity="0.9" />
        <path d="M7 10V7a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M3 3l18 18" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" />
      </svg>
    </div>

    <div>
      <h1 id="title">No Access — Accès refusé</h1>
      <p>Vous n'avez pas l'autorisation d'accéder à cette page. Cela peut être dû à des droits insuffisants, une session expirée, ou des règles de sécurité.</p>

      <div class="meta" aria-hidden="false">
        <div class="chip">Code: 403</div>
        <div class="chip">Contactez l'administrateur si vous pensez qu'il s'agit d'une erreur</div>
        <div class="chip">Réessayez après vous être reconnecté</div>
      </div>

      <div class="actions" role="group" aria-label="Actions">
        <li class="nav-item"><a class="nav-link active" href="/home">Retour</a></li>
        <?php if (!session()->get('LoginId')): ?>
          <li class="nav-item"><a class="nav-link active" href="/ConnexionInscription ">Se Connecter</a></li>
        <?php endif; ?>
        <div class="support">ou <a href="mailto:support@example.com" style="color:inherit;text-decoration:underline">contacter le support</a></div>
      </div>

      <footer>
        <strong>Conseil :</strong> si vous êtes l'administrateur, vérifiez la configuration du serveur (fichiers .htaccess, règles nginx, ou permissions système) et les logs pour plus d'informations.
      </footer>
    </div>
  </main>

  <script>
    function goBack(){
      // try history first, otherwise fallback to home
      if(document.referrer && history.length>1){ history.back(); }
      else { window.location.href = '/'; }
    }
    function reloadAuth(){
      // try to clear a common cookie prefix used for session and reload
      try{ document.cookie = 'session=; path=/; max-age=0'; }catch(e){}
      // if your app uses a specific auth path, update the location below
      window.location.href = '/login';
    }

    // accessibility: focus the main title for screen readers
    window.addEventListener('load', ()=>{ document.getElementById('title').focus?.(); });
  </script>
</body>
</html>
