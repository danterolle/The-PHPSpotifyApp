const div = document.querySelector("div");
const IDPlaylist = div.ID;
let Vettore = Array();
let vet = Array();
var currentUrl = new URL(window.location.href);
console.log(currentUrl);
var getID = currentUrl.searchParams.get('IDPlaylist');
console.log(getID);

function OnJson(json){
    let i = 0;
    for(event of json){
        Vettore[i] = {"ID":event.IDBrano,"Titolo": event.Brano,"artista":event.Artista, "albulm":event.Albulm, "url" : event.Url_immagine};
        i++;
    }
    console.log(Vettore);
    stampaContenuti();
}
function OnResponseJson(respone){
    return respone.json();
}
function stampaContenuti(){
    const section = document.querySelector("#VisualizzaContenuti");
    for(let i = 0;i<Vettore.length;i++){
        console.log(Vettore[i]);
        const div = document.createElement("div");
        div.classList.add("raccolta");
        div.setAttribute("ID",Vettore[i].ID);
        const a = document.createElement("p");
        const titolo = document.createTextNode(Vettore[i].Titolo);
        const img = document.createElement("img");
        const button = document.createElement("button");
        const cancella = document.createTextNode("Cancella brano");
        img.src = Vettore[i].url;
        a.appendChild(titolo);
        button.appendChild(cancella);
        div.appendChild(a);
        div.appendChild(img);
        div.appendChild(button);
        button.style.fontSize = "20px";
        section.appendChild(div);
        console.log("creato "+i);
        button.addEventListener("click",CancellaContenuto);
        div.addEventListener("click",Show);
    }
}

function Show(event){
    event.currentTarget.removeEventListener("click",Show);
    const container = event.currentTarget;
    let ID = container.ID;
    console.log(ID);
    fetch("http://localhost/Homework1/ajax_show_contenuto.php?ID="+ID).then(OnResponseJson).then(ShowContenuti);
}

function ShowContenuti(json) {
    let i = 0;
    for(event of json){
        vet[i] = {"ID":event.IDBrano,"Titolo": event.Brano,"artista":event.Artista, "albulm":event.Albulm, "url" : event.Url_immagine};
        i++;
    }
    const show = document.getElementByID(vet[0].ID);
    const a = document.createElement("p");
    const artista = document.createTextNode(vet[0].artista);
    const b = document.createElement("p");
    const albulm = document.createTextNode(vet[0].albulm);
    a.appendChild(artista);
    b.appendChild(albulm);
    a.classList.add("kk");
    b.classList.add("kk");
    a.setAttribute("ID","childa");
    b.setAttribute("ID","childb");
    show.appendChild(a);
    show.appendChild(b);
    show.addEventListener("click",Deseleziona);
}
function Deseleziona(event){
    event.currentTarget.removeEventListener("click",Deseleziona);
    const container = event.currentTarget;
    let ID = container.ID;
    console.log(ID);
    container.removeChild(container.lastChild);
    container.removeChild(container.lastChild);
    container.addEventListener("click",Show);

}
function CancellaContenuto(event){
    var a = event.currentTarget;
    var b = a.parentNode.ID;
    console.log(b);
    fetch("http://localhost/Homework1/ajax_delete_contenuto.php?ID="+getID+"&IDBrano="+b).then(Fine);

}
function Fine(json){
    window.location.href = "collection.php?IDPlaylist="+getID;
}
fetch("http://localhost/Homework1/ajax_get_contenuto.php?ID="+getID).then(OnResponseJson).then(OnJson);