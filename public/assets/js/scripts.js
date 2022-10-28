// admin activer btn franchise  


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


// admin activer btn Structure  

window.onload = () => {
    let active = document.querySelectorAll("[type=checkbox]")
    for (let button of active) {
        button.addEventListener("click", function() {
            let xmlhttp = new XMLHttpRequest;
            //xmlhttp.onReadyStateChange = () => {
                //verifier la reponse :200
            //}
            xmlhttp.open("get",`/admin/activer_une_structure/${this.dataset.id}`)
            xmlhttp.send()
        })
    }
}

// Ajout d'une modale pour supprimer une franchise

      const myModal = document.getElementById('myModal')
      const myInput = document.getElementById('myInput')

      myModal.addEventListener('shown.bs.modal', () => {
      myInput.focus()
      })

      let Delete = document.querySelectorAll(".delete_franchise")
      for (let bouton of Delete ) {
        bouton.addEventListener("click", function() {
          document.querySelector(".validerDelete").href=`/admin/supprimer_une_franchise/${this.dataset.id}`
          document.querySelector(".modal-body").innerText = `Etes vous sûrs de vouloir supprimer la franchise "${this.dataset.name}"?`
        })
        
      }




    

