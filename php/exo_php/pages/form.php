<?php
$success = false;
$formData = [];
$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //récupération et nettoyage des données du formulaire

    $formData = [
        "nom" => test_input($_POST['nom'] ?? ''),

        "prenom" => test_input($_POST['prenom']?? ''),

        "civilite"=>($_POST['civilite']?? ''),

        "email" => filter_var($_POST['email'] ??'' , FILTER_SANITIZE_EMAIL),

        "date_naissance" =>$_POST["date_naissance"],

        "telephone" =>$_POST["telephone"],

        "site_web" =>$_POST["site_web"],

        "langues" =>$_POST["langues"] ?? [],
        "interets" =>$_POST["interets"] ?? [],

        "genre" =>$_POST["genre"],
        "validate" =>$_POST["validate"],

        "age" =>filter_var($_POST¨["age"] ?? ' ',FILTER_SANITIZE_NUMBER_INT),
    ];
    
}

//validation des champs obligatoires

if (empty($formData['nom'])) {
    $errors[] = "Le nom est requis";
}
if (empty($formData['prenom'])) {
    $errors[] = "Le prenom est requis";
}
if (empty($formData['email'])) {
    $errors[] = "L'email est obligatoire";
}elseif( !filter_var($formData['email'] ??'' , FILTER_SANITIZE_EMAIL)){
    $errors[] = "L'email n'est pas vaide";

}

if(empty($errors)){
    $success = true;
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<?php
  $about = "form";
include_once __DIR__ . '/../includes/header.inc.php';

?>
    <div class="container">
        
        <h1>Formulaire</h1>
        <p class="subtitle">Veuillez renseigner tous les champs</p>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <strong>⚠️ Erreurs détectées :</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <strong>✅ Formulaire soumis avec succès !</strong>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?=  $_SERVER["PHP_SELF"] ?>">
            
            <!-- Section Informations Personnelles -->
            <div class="form-section">
                <h2>👤 Informations Personnelles</h2>
                
                <div class="form-group">
                    <label for="nom">Nom <span class="">*</span></label>
                    <input type="text" id="nom" name="nom" placeholder="Votre nom" 
                           value="<?php echo htmlspecialchars($formData['nom'] ?? ''); ?>" >
                </div>
                
                <div class="form-group">
                    <label for="prenom">Prénom <span class="required">*</span></label>
                    <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" 
                           value="<?php echo htmlspecialchars($formData['prenom'] ?? ''); ?>" >
                </div>
                
                <div class="form-group">
                    <label>Civilité <span class="required">*</span></label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="mr" name="civilite" value="M." 
                                   <?php echo (isset($formData['civilite']) && $formData['civilite'] === 'M.') ? 'checked' : ''; ?>>
                            <label for="mr">Monsieur</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="mme" name="civilite" value="Mme" 
                                   <?php echo (isset($formData['civilite']) && $formData['civilite'] === 'Mme') ? 'checked' : ''; ?>>
                            <label for="mme">Madame</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="autre" name="civilite" value="Autre" 
                                   <?php echo (isset($formData['civilite']) && $formData['civilite'] === 'Autre') ? 'checked' : ''; ?>>
                            <label for="autre">Autre</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="genre">Genre <span class="required">*</span></label>
                    <select id="genre" name="genre" >
                        <option value="">-- Sélectionnez --</option>
                        <option value="homme" <?php echo (isset($formData['genre']) && $formData['genre'] === 'homme') ? 'selected' : ''; ?>>Homme</option>
                        <option value="femme" <?php echo (isset($formData['genre']) && $formData['genre'] === 'femme') ? 'selected' : ''; ?>>Femme</option>
                        <option value="autre" <?php echo (isset($formData['genre']) && $formData['genre'] === 'autre') ? 'selected' : ''; ?>>Autre</option>
                        <option value="non-binaire" <?php echo (isset($formData['genre']) && $formData['genre'] === 'non-binaire') ? 'selected' : ''; ?>>Non-binaire</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="date_naissance">Date de naissance <span class="required">*</span></label>
                    <input type="date" id="date_naissance" name="date_naissance" 
                           value="<?php echo htmlspecialchars($formData['date_naissance'] ?? ''); ?>" >
                </div>
                
                <div class="form-group">
                    <label for="age">Âge <span class="required">*</span></label>
                    <input type="number" id="age" name="age" min="1" max="120" placeholder="Votre âge" 
                           value="<?php echo htmlspecialchars($formData['age'] ?? ''); ?>" >
                </div>
            </div>
            
                       <!-- Section Contact -->
            <div class="form-section">
                <h2>Contact</h2>
               
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" placeholder="exemple@email.com"
                           value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>" >
                </div>
               
                <div class="form-group">
                    <label for="telephone">Téléphone <span class="required">*</span></label>
                    <input type="tel" id="telephone" name="telephone" placeholder="0612345678"
                           pattern="[0-9]{10}" value="<?php echo htmlspecialchars($formData['telephone'] ?? ''); ?>" >
                </div>
               
                <div class="form-group">
                    <label for="site_web">Site Web</label>
                    <input type="url" id="site_web" name="site_web" placeholder="https://exemple.com"
                           value="<?php echo htmlspecialchars($formData['site_web'] ?? ''); ?>">
                </div>
            </div>
     
           
            <!-- Section Préférences -->
            <div class="form-section">
                <h2>Préférences</h2>
               
                <div class="form-group">
                    <label>Langues parlées</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="francais" name="langues[]" value="Français"
                                   <?php echo (isset($formData['langues']) && in_array('Français', $formData['langues'])) ? 'checked' : ''; ?>>
                            <label for="francais">Français</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="anglais" name="langues[]" value="Anglais"
                                   <?php echo (isset($formData['langues']) && in_array('Anglais', $formData['langues'])) ? 'checked' : ''; ?>>
                            <label for="anglais">Anglais</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="espagnol" name="langues[]" value="Espagnol"
                                   <?php echo (isset($formData['langues']) && in_array('Espagnol', $formData['langues'])) ? 'checked' : ''; ?>>
                            <label for="espagnol">Espagnol</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="allemand" name="langues[]" value="Allemand"
                                   <?php echo (isset($formData['langues']) && in_array('Allemand', $formData['langues'])) ? 'checked' : ''; ?>>
                            <label for="allemand">Allemand</label>
                        </div>
                    </div>
                </div>
               
                <div class="form-group">
                    <label>Centres d'intérêt</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="sport" name="interets[]" value="Sport"
                                   <?php echo (isset($formData['interets']) && in_array('Sport', $formData['interets'])) ? 'checked' : ''; ?>>
                            <label for="sport">Sport</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="musique" name="interets[]" value="Musique"
                                   <?php echo (isset($formData['interets']) && in_array('Musique', $formData['interets'])) ? 'checked' : ''; ?>>
                            <label for="musique">Musique</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="lecture" name="interets[]" value="Lecture"
                                   <?php echo (isset($formData['interets']) && in_array('Lecture', $formData['interets'])) ? 'checked' : ''; ?>>
                            <label for="lecture">Lecture</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="voyage" name="interets[]" value="Voyage"
                                   <?php echo (isset($formData['interets']) && in_array('Voyage', $formData['interets'])) ? 'checked' : ''; ?>>
                            <label for="voyage">Voyage</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="technologie" name="interets[]" value="Technologie"
                                   <?php echo (isset($formData['interets']) && in_array('Technologie', $formData['interets'])) ? 'checked' : ''; ?>>
                            <label for="technologie">Technologie</label>
                        </div>
                    </div>
                </div>
            </div>
           
            <!-- Section Acceptation -->
            <div class="form-section">
                <h2>Acceptation</h2>
               
                <div class="form-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="newsletter" name="newsletter" value="1"
                               <?php echo (isset($formData['newsletter']) && $formData['newsletter'] === 'Oui') ? 'checked' : ''; ?>>
                        <label for="newsletter">Je souhaite recevoir la newsletter</label>
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="conditions" name="conditions" value="1"
                               <?php echo (isset($formData['conditions']) && $formData['conditions'] === 'Oui') ? 'checked' : ''; ?>>
                        <label for="conditions">J'accepte les conditions d'utilisation <span class="required">*</span></label>
                    </div>
                </div>
            </div>
 

            
            <button type="submit" class="btn-submit" name="validate">Soumettre le formulaire</button>
        </form>
    </div>

    <?php if($_SERVER['REQUEST_METHOD'] === 'POST') :?>
    <div class="result-section">
        <h3>Récapitulatif des données soumisses</h3>

        <div class="result-item">
            <span class="result-label">Nom complet:</span>
            <?=$formData['civilite'] .' '.$formData['prenom'] . ' ' . $formData['nom']?>    

        </div>
        <div>
            <span class="result-label">Genre:</span>
            <?=$formData['genre'] ?>
        </div>

        <div>
            <span class="result-label">Date de naissance:</span>
            <?=$formData['date_naissance'] ?>
        </div>

        <div>
            <span class="result-label">Age:</span>
            <?=$formData['age'] ?>
        </div>

        <div class="result-item">
            <span class="result-label">Email:</span>
            <?=$formData['email'] ?>
        </div>

        <div>
            <span class="result-label">Téléphone:</span>
            <?=$formData['telephone'] ?>
        </div>

        <div>
            <span class="result-label">Site Web:</span>
            <?=$formData['site_web'] ?>
        </div>

     
        <p><span class="result-label">Langues parlées :</span>
                <?= !empty($formData['langues']) ? implode(', ', $formData['langues']) : 'Aucune sélectionnée'; ?>
            </p>
 
            <p><span class="result-label">Centres d’intérêt :</span>
                <?= !empty($formData['interets']) ? implode(', ', $formData['interets']) : 'Aucun sélectionné'; ?>
            </p>
          

    

        <div>
            <span class="result-label">Newsletter:</span>
            <?php
            if (isset($formData['newsletter']) && $formData['newsletter'] === 'Oui') {
                echo 'Oui';
            } else {
                echo 'Non';
            }
            ?>
        </div>

        <div>
            <span class="result-label">Conditions acceptées:</span>
            <?php
            if (isset($formData['conditions']) && $formData['conditions'] === 'Oui') {
                echo 'Oui';
            } else {
                echo 'Non';
            }
            ?>
        </div>

     
        <?php endif; ?>
    </div>
<?php

 include_once __DIR__ . '/../includes/footer.inc.php';
?>
  
 

