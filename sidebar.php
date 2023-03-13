<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="index.php">
        <i class="bi bi-grid"></i>
        <span>Tableau de bord</span>
      </a>
    </li><!-- Fin menu dashboard -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#auteurs-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-app-store-line"></i><span>AUTEURS</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="auteurs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="auteur/liste_des_auteurs.php">
            <i class="bi bi-circle"></i><span>Liste des auteurs</span>
          </a>
        </li>
        <li>
          <a href="auteur/ajouter_auteurs.php">
            <i class="bi bi-circle"></i><span>Ajouter un auteur</span>
          </a>
        </li>
        
      </ul>
    </li>
    <!-- Fin menu auteur -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ouvrages-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-book-fill"></i><span>OUVRAGES</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ouvrages-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="ouvrage/liste_des_ouvrages.php">
              <i class="bi bi-circle"></i><span>Liste des ouvrages</span>
            </a>
          </li>
          <li>
            <a href="ouvrage/ajouter_ouvrage.php">
              <i class="bi bi-circle"></i><span>Ajouter un ouvrage </span>
            </a>
          </li>
        </ul>
      </li>
      <!-- Fin menu ouvrage -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#langues-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-pencil-fill"></i><span>LANGUES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="langues-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="langue/liste_des_langues.php">
            <i class="bi bi-circle"></i><span>Liste des langues</span>
          </a>
        </li>
        <li>
          <a href="langue/ajouter_langue.php">
            <i class="bi bi-circle"></i><span>Ajouter une langue</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- Fin menu langue -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#emprunts-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-edge-line"></i><span>EMPRUNTS</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="emprunts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="emprunt/liste_des_emprunts.php">
            <i class="bi bi-circle"></i><span>Liste des emprunts</span>
          </a>
        </li>
        <li>
          <a href="emprunt/ajouter_emprunt.php">
            <i class="bi bi-circle"></i><span>Ajouter un emprunt</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu emprunt -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#membres-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-medium-line"></i><span>MEMBRES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="membres-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="membre/liste_des_membres.php">
            <i class="bi bi-circle"></i><span>Liste des membres</span>
          </a>
        </li>
        <li>
          <a href="membre/ajouter_membre.php">
            <i class="bi bi-circle"></i><span>Ajouter un membre</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu membre -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#membres_indelicats-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-markdown-line"></i><span>MEMBRES INDELICATS</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="membres_indelicats-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="membre_indelicat/liste_des_membres_indelicats.php">
              <i class="bi bi-circle"></i><span>Liste des membres indélicats</span>
            </a>
          </li>
          <li>
            <a href="membre_indelicat/ajouter_membre_indelicat.php">
              <i class="bi bi-circle"></i><span>Ajouter un membre indélicat</span>
            </a>
          </li>
        </ul>
      </li><!-- Fin menu membre indélicat -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#domaines-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-earth-line"></i><span>DOMAINES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="domaines-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="domaine/liste_des_domaines.php">
            <i class="bi bi-circle"></i><span>Liste des domaines</span>
          </a>
        </li>
        <li>
          <a href="domaine/ajouter_domaine.php">
            <i class="bi bi-circle"></i><span>Ajouter un domaine</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin  menu domaine -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#domaines_ouvrages-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-book-open-line"></i><span>DOMAINES OUVRAGES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="domaines_ouvrages-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="domaine_ouvrage/liste_des_domaines_ouvrages.php">
            <i class="bi bi-circle"></i><span>Liste des domaines ouvrages</span>
          </a>
        </li>
        <li>
          <a href="domaine_ouvrage/ajouter_domaine_ouvrage.php">
            <i class="bi bi-circle"></i><span>Ajouter un domaine ouvrage</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu domaine ouvrage -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#date_parution-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-calendar-event-line"></i><span>DATE PARUTION</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="date_parution-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="date_parution/liste_des_dates_parutions.php">
            <i class="bi bi-circle"></i><span>Liste des dates parutions</span>
          </a>
        </li>
        <li>
          <a href="date_parution/ajouter_date_parution.php">
            <i class="bi bi-circle"></i><span>Ajouter une date parution</span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu date parution -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#auteurs_secondaires-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-input-method-line"></i><span>AUTEURS SECONDAIRES</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="auteurs_secondaires-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="auteur_secondaire/liste_des_auteurs_secondaires.php">
            <i class="bi bi-circle"></i><span>Liste des auteurs secondaire</span>
          </a>
        </li>
        <li>
          <a href="auteur_secondaire/ajouter_auteur_secondaire.php">
            <i class="bi bi-circle"></i><span>Ajouter un auteur secondaire </span>
          </a>
        </li>
      </ul>
    </li><!-- Fin menu date parution -->
   
    <li class="nav-heading">Pages</li>
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="mon-profil.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link " href="aide.php">
        <i class="bi bi-question-circle"></i>
        <span>Aide</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="contact.php">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
      </a>
    </li><!-- End Contact Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="login.php">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Connexion</span>
      </a>
    </li><!-- End Login Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-error-404.php">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
      </a>
    </li><!-- End Error 404 Page Nav -->
  </ul>
  
  </aside><!-- End Sidebar-->