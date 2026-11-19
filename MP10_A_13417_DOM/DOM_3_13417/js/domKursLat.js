var targetNode;

function init() {
    targetNode = document.getElementById("hasil").firstChild;
    hitungKurs("idr");
}

function hitungKurs(id) {
    var inputEl = document.getElementById(id);
    var nominal = parseFloat(inputEl.value);
    var hasilUsd = nominal / 18246;
    targetNode.data = hasilUsd.toFixed(2);

    var liBaru = document.createElement("li");   
    var teksRiwayat = document.createTextNode("Rp" + nominal + " = US$" + hasilUsd.toFixed(2));
    
    liBaru.appendChild(teksRiwayat);
    document.getElementById("riwayat").appendChild(liBaru);
}