// Ajout des permissions à la franchises ( permissions globales)

        let collection, boutonAjout, span;
        window.onload = ()=> {
            collection = document.querySelector("#globalePermission");
            span = collection.querySelector("span");
            boutonAjout = document.createElement("button");
            boutonAjout.className = "ajout-FranchisePermission btn btn-warning";
            boutonAjout.innerText = "Ajouter une permission";

            let nouveauBouton = span.append(boutonAjout);

            collection.dataset.index = collection.querySelectorAll("input").length; 

            boutonAjout.addEventListener("click", function() {
                addButton(collection, nouveauBouton);
            });
        }
        function addButton(collection, nouveauBouton) {

            let prototype = collection.dataset.prototype;

            let index = collection.dataset.index;

            prototype = prototype.replace(/__name__/g, index);

            let content = document.createElement("html");
            content.innerHTML = prototype;
            let newForm = content.querySelector("div");

            let boutonSuppr = document.createElement("button");
            boutonSuppr.type = "button";
            boutonSuppr.className = "btn red";
            boutonSuppr.id= "delete-FranchisePermission-" + index;
            boutonSuppr.innerText = "Supprimer cette permission";

            newForm.append(boutonSuppr);
            collection.dataset.index++;

            let boutonAjout = collection.querySelector(".ajout-FranchisePermission");

            span.insertBefore(newForm, boutonAjout);

            boutonSuppr.addEventListener("click", function() {
                this.previousElementSibling.parentElement.remove();
            })
        }

//formulaire dynamique et collectionType

    window.onload =() => {
    // on recherche la franchise
    let franchise = document.querySelector("#structure_FranchisePermission");
    
    franchise.addEventListener("change", function() {
         //rechercher la balise la plus proche de mon element (parent)
        let form = this.closest("form");
        let data = this.name + "=" + this.value;
         //envoie en ajax
        fetch(form.action, {
            method : form.getAttribute("method"),
            body: data, 
            headers: {
                "Content-Type" : "application/x-www-form-urlencoded; charset:UTF-8"
            }
        
        //Traiter la reponse
        .then(response = response.text())
        .then(html => {
            let content = document.createElement("html");
            content.innerHTML = html;
            let newSelect = content.querySelector("#structure_FranchisePermission");
            document.querySelector("#structure_FranchisePermission").replaceWith(newSelect);
        })
        .catch(error => {
            console.log(error)
        })
    });
}
    )} 


// admin activer btn franchise panel  


    window.onload = () => {
        let active = document.querySelectorAll("[type=checkbox]")
        for (let button of active) {
            button.addEventListener("click", function() {
                let xmlhttp = new XMLHttpRequest;
                //xmlhttp.onReadyStateChange = () => {
                    //verifier la reponse :200
                //}
                xmlhttp.open("get",`/admin/activer_une_franchise/${this.dataset.id}`)
                xmlhttp.send()
            })
        }
    }

// Ajout d'un bouton supprimer via modale

      const myModal = document.getElementById('myModal')
      const myInput = document.getElementById('myInput')

      myModal.addEventListener('shown.bs.modal', () => {
      myInput.focus()
      })

      let Delete = document.querySelectorAll(".modal")
      for (let bouton of Delete ) {
        bouton.addEventListener("click", function() {
          document.querySelector(".validerDelete").href=`/admin/supprimer_une_franchise/${this.dataset.id}`
          document.querySelector(".modal-body").innerText = `Etes vous sûrs de vouloir supprimer la franchise "${this.dataset.name}"?`
        })
        
      }

// Accès permissions dans la franchise avec TomSelect

async function jsonFetch (url) {
    const response = await fetch(url, {
        headers : {
            Accept : 'application/json'
        }
    })

    if (response.status === 204) {
        return null;
    }

    if (response.ok) {
    return await response.json()

    }
    throw response
}

// SearchableEntity et TomSelect
    /**
     * @param {HTMLSelectElement} select
     */

    function binSelect (select) {
        new TomSelect (select, {
            hideSelected: true,
            closeAfterSelect: true,
            valueField: select.dataset.value, 
            labelField :  select.dataset.label,
            searchField : select.dataset.label,
            plugins : {
                remove_button : { title : 'Supprimer cet élément'}
            },
            load: async (query, callback) => {
                const url = `$(select.dataset.remote)?q=${encodeURIComponent(query)}`
                callback(await jsonFetch(url))
            }
        })
    }

    Array.from(document.querySelectorAll('select[multiple]')).map(binSelect)


    

