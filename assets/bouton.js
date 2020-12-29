
//---------------------------------------------------------------------------------
// Ajout des inputs INGREDIENTS

document.addEventListener('DOMContentLoaded', function() {
    let addButton = document.getElementById('ingredient-add-item');
    console.log('123');

    addButton.addEventListener('click', function (e) {
        e.preventDefault();

        // Récupérer les attributs de données
        let index = addButton.dataset.index;
        let prototype = addButton.dataset.prototype;    
        
        
        // Créer un nouveau formulaire et MAJ index
        addButton.dataset.index = index +1;
        let protoForm = document.createElement('div');
        protoForm.innerHTML = prototype.replace(index, /__name__/g);
        protoForm = protoForm.firstChild;
        protoForm.classList.add('recette_form');
      
        console.log(protoForm);
        

        // Champs du conteneur
        // let mediaContent = document.createElement('div');
        // mediaContent.classList.add('media-content');

        //----------------------------------------------------------------------
        // Delete button
        console.log('666');
        protoForm.innerHTML += `<button type="button" class="button is-small is-danger is-light is-pulled-right form-collection-remove" data-form-item=".recette_form">
            Supprimer
        </button> `;

        console.log('77');

        protoForm.querySelector('button').addEventListener('click', function (e) {
            e.preventDefault();
            let item = protoForm.querySelector('button').closest(protoForm.querySelector('button').dataset.formItem);

        console.log(item)

            if (item !== null) {
                item.remove();
            }
        });

        console.log('888');

        // mediaContent.querySelector('.columns').appendChild(quantite);
        // mediaContent.querySelector('.columns').appendChild(nom);

        // Conteneur principal
        // let newForm = document.createElement('div');
        // newForm.classList.add('media', 'ingredient');
        // newForm.appendChild();

        //----------------------------------------------------------------------

        // Ajoute le formulaire à la liste
        // addButton.closest('.field').appendChild(newForm);
        document.getElementById('ingredient_list').appendChild(protoForm);
    });
});

//---------------------------------------------------------------------------------
// Ajout des inputs USTENSILES

document.addEventListener('DOMContentLoaded', function() {
    let addButton = document.getElementById('ustensile-add-item');
    console.log('123');

    addButton.addEventListener('click', function (e) {
        e.preventDefault();

        // Récupérer les attributs de données
        let prototypes = addButton.dataset.prototype;
        let index = addButton.dataset.index;
        console.log('123');
        

        // Créer un nouveau formulaire et MAJ index
        let protoForms = document.createElement('div');
        protoForms.innerHTML = prototypes.replace(/__name__/g, index);
        protoForms = protoForms.firstChild;
        addButton.dataset.index = index + 1;
        protoForms.classList.add('recette_form');

       
        //----------------------------------------------------------------------
        // Créér un custom formulaire 

        // // Main column: quantité
        // let primaryColumn = document.createElement('div');
        // primaryColumn.classList.add('column');
        // primaryColumn.appendChild(protoForm.querySelector('div.field:nth-child(2)').cloneNode(true));
        

        // // Secondary column: ingrédients
        // let secondaryColumn = document.createElement('div');
        // secondaryColumn.classList.add('column', 'is-two-fifths');
        // secondaryColumn.appendChild(protoForm.querySelector('div.field:nth-child(1)').cloneNode(true));
       

        // Champs du conteneur
        // let mediaContent = document.createElement('div');
        // mediaContent.classList.add('media-content');

        // // Delete button
        // mediaContent.innerHTML = `
        // <button type="button" class="button is-small is-danger is-light is-pulled-right form-collection-remove" data-form-item=".ingredient">
        //     <span class="icon"><i class="fal fa-times"></i></span>
        // </button>
        // <div class="columns"></div>`;

        // mediaContent.querySelector('button').addEventListener('click', function (e) {
        //     e.preventDefault();
        //     let item = mediaContent.querySelector('button').closest(mediaContent.querySelector('button').dataset.formIngredient);

        //     if (item !== null) {
        //         item.remove();
        //     }
        // });

        // mediaContent.querySelector('.columns').appendChild(primaryColumn);
        // mediaContent.querySelector('.columns').appendChild(secondaryColumn);

        // // Conteneur principal
        // let newForm = document.createElement('div');
        // newForm.classList.add('media', 'ingredient');
        // newForm.appendChild(mediaContent);

        //----------------------------------------------------------------------

        // Ajoute le formulaire à la liste
        // addButton.closest('.field').appendChild(newForm);
         // Delete button
         console.log('666');
         protoForms.innerHTML += `<button type="button" class="button is-small is-danger is-light is-pulled-right form-collection-remove" data-form-item=".recette_form">
             <span class="icon">Supprimer</span>
         </button> `;
 
         console.log('77');
 
         protoForms.querySelector('button').addEventListener('click', function (e) {
             e.preventDefault();
             let item = protoForms.querySelector('button').closest(protoForms.querySelector('button').dataset.formItem);
 
         console.log(item)
 
             if (item !== null) {
                 item.remove();
             }
         });
        document.getElementById('ustensile_list').appendChild(protoForms);
    });
});