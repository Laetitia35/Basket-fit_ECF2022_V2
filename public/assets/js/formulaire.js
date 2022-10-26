// Formulaire dynamique avec CollectionType

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