let raccolta = "";
let Vettore = Array();

function OnJson(json){
    let i = 0;
    for(event of json){
        Vettore[i] = {"ID":event.ID,"Titolo": event.Titolo, "url" : event.Url_immagine};
        i++;
    }
    console.log(Vettore);
    stampaRaccolta();
}

function stampaRaccolta(){
    const section = document.querySelector("#visualizzaPlaylist");
    for(let i = 0;i<Vettore.length;i++){
        console.log(Vettore[i]);
        const div = document.createElement("div");
        div.classList.add("raccolta");
        div.setAttribute("ID",Vettore[i].ID);
        const a = document.createElement("h3");
        const titolo = document.createTextNode(Vettore[i].ID+". "+Vettore[i].Titolo);
        const img = document.createElement("img");
        img.src = Vettore[i].url;
        a.appendChild(titolo);
        div.appendChild(a);
        div.appendChild(img);
        section.appendChild(div);
        console.log("creato "+i);
        div.addEventListener("click",Collection);
    }
}

function OnSubmit(event){
    event.preventDefault();
    if(form.create.value.length === 0){
        alert ("Inserisci nome raccolta...");
    }
    else{
        raccolta = form.create.value;
        alert ("Playlist creata con successo!");
        fetch("http://localhost/Homework1/ajax_insert_playlist.php?titolo="+raccolta).then(ReFetch);
    }
}

function ReFetch(){
    let elements = document.querySelectorAll(".raccolta");
    for(element of elements){
        element.parentNode.removeChild(element);
    }
    fetch("http://localhost/Homework1/ajax_get_raccolta.php").then(OnResponseJson).then(OnJson);
}


function Collection(event){
    const container = event.currentTarget;
    let ID = container.ID;
    console.log(ID);
    window.location.href = "collection.php?IDPlaylist="+ID;
}


function OnResponseJson(response){
    return response.json();
}

fetch("http://localhost/Homework1/ajax_get_raccolta.php").then(OnResponseJson).then(OnJson);
const form = document.forms["create"];
form.addEventListener("submit",OnSubmit);

