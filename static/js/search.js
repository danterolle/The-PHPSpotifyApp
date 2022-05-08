let vettore = Array();
let container = "";
let raccolta = "";
let nomeTraccia = "";
let IDPlaylist = "";
let imgRaccolta = "";

function Richiedi(event){
    event.preventDefault();
    let elements = document.querySelectorAll(".contenitore");
    // eliminare i risultati della ricerca precedente
    for(let element of elements){
        element.parentNode.removeChild(element);
    }
    const testo = form.cerca.value;
    console.log(testo);
    fetch("http://localhost/Homework1/do_search.php?testo="+testo).then(OnResponseJson).then(OnJson);
}

function OnJson(json){
    for (event in json) {
        if (json.hasOwnProperty(event)) {
          const val = json[event];
          console.log(val);
          let i = 0;
          for(evento of val.items){
              vettore[i] = {'nome':evento.name , 'ID_track':evento.ID, 'artist':evento.artists[0].name, 'album':evento.album.name, 'url':evento.album.images[0].url};
              const section = document.querySelector("#contenuti");
              const div = document.createElement("div");
              div.classList.add("contenitore");
              div.setAttribute("ID",""+i);
              const a_nome = document.createElement("a");
              const a_ID = document.createElement("a");
              const a_artista = document.createElement("a");
              const a_album = document.createElement("a");
              const nome = document.createTextNode("Nome: "+evento.name);
              const ID = document.createTextNode("ID spotify: "+evento.ID);
              const artista = document.createTextNode("Artista: "+evento.artists[0].name);
              const album = document.createTextNode("Album: "+evento.album.name);
              const img = document.createElement("img");
              img.src = evento.album.images[0].url;
              a_album.appendChild(album);
              a_nome.appendChild(nome);
              a_artista.appendChild(artista);
              a_ID.appendChild(ID);
              div.appendChild(a_nome);
              div.appendChild(a_artista);
              div.appendChild(a_album);
              div.appendChild(a_ID);
              div.appendChild(img);
              section.appendChild(div);
              div.addEventListener('click',OnSelect);
              i++;
          }
        }
    }
}

function OnSelect(event){
    DeselezionaTutto();
    container = event.currentTarget;
    const elements = document.querySelectorAll(".contenitore");
    for(let element of elements){
        if(element != container) element.style.opacity = 0.6;
    }

    const p = document.getElementByID("afterSelect");
    p.classList.remove("hIDden");
    formRaccolta.classList.remove("hIDden");
}

function DeselezionaTutto(){
    const elements = document.querySelectorAll(".contenitore");
    for(let element of elements){
        element.style.opacity = 1;
    }
}



function inserisciRaccolta(event){
    raccolta = formRaccolta.raccolta.value;
    if(raccolta.length === 0){
        event.preventDefault();
        alert ("Inserisci il nome della playlist...");
    }
    else{
        event.preventDefault();
        console.log(raccolta);
        fetch("http://localhost/Homework1/ajax_get_raccolta.php").then(OnResponseJson).then(Verifica);
    }
}

function Verifica(json){
    let valido = false;
    for(event of json){
        console.log(event);
        if(event.Titolo == raccolta){
            valIDo = true; //se tra le playlist dell'utente(attivo) è presente quella il cui titolo è uguale (MAIUSC comprese) a ciò che l'utente ha digitato 
            IDPlaylist = event.ID;
            imgRaccolta = event.Url_immagine;
            console.log(valido);
            break;
        }
    }
    if(valIDo == true){
        const i = container.ID;
        const dati = vettore[i];
        const nomeTraccia = dati['nome'];
        const IDBrano = dati['ID_track'];
        const artist = dati['artist'];
        const album = dati['album'];
        const urlImg = dati['url'];
        if(imgRaccolta !== urlImg){
            fetch("http://localhost/Homework1/ajax_update_playlist.php?IDPlaylist="+IDPlaylist+"&url="+urlImg);
        }
        fetch("http://localhost/Homework1/ajax_insert_contenuto.php?IDPlaylist="+IDPlaylist+"&nome="+nomeTraccia+"&IDBrano="+IDBrano+"&artist="+artist+"&album="+album+"&url="+urlImg).then(doFetch);
    }
    else{
        console.log("Non esiste questa playlist per questo utente!");
        alert("Non esiste questa playlist per questo utente!");
    }
}

function doFetch(){
    fetch("http://localhost/Homework1/ajax_get_raccolta.php").then(OnResponseJson).then(confermaInsert);
}

function confermaInsert(json){
    console.log("CONTROLLO INSERIMENTO...");
    for(event of json){
        if(event.Brano = nomeTraccia){
            let elements = document.querySelectorAll(".contenitore");
            for(let element of elements){
                element.parentNode.removeChild(element);
            }
            const p = document.getElementByID("afterSelect");
            p.classList.add("hidden");
            form.classList.remove("hidden");
            formRaccolta.classList.add("hidden"); 
        }
    }
    alert ("Brano aggiunto alla playlist!");h
}


function OnResponseJson(response){
    return response.json();
}

const form = document.forms['search'];
const formRaccolta = document.forms['selectR'];
form.addEventListener("submit",Richiedi);
formRaccolta.addEventListener("submit",inserisciRaccolta);

