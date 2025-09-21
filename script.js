async function getData() {
  const res = await fetch("api.php");
  const data = await res.json();
  renderData(data);
}

function renderData(data) {
  const list = document.getElementById("dataList");
  list.innerHTML = "";
  data.forEach(item => {
    list.innerHTML += `
      <li>
        <span>${item.nama}</span>
        <div>
          <button class="edit" onclick="editData(${item.id}, '${item.nama}')">Edit</button>
          <button class="delete" onclick="deleteData(${item.id})">Hapus</button>
        </div>
      </li>
    `;
  });
}

async function addData() {
  const input = document.getElementById("inputData");
  if (input.value.trim() === "") {
    alert("Isi dulu datanya!");
    return;
  }
  await fetch("api.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ nama: input.value })
  });
  input.value = "";
  getData();
}

async function editData(id, oldValue) {
  const newValue = prompt("Edit data:", oldValue);
  if (newValue && newValue.trim() !== "") {
    await fetch("api.php", {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id, nama: newValue })
    });
    getData();
  }
}

async function deleteData(id) {
  if (confirm("Yakin ingin menghapus data ini?")) {
    await fetch("api.php", {
      method: "DELETE",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id })
    });
    getData();
  }
}

// Load data awal
getData();
