document.addEventListener("DOMContentLoaded", () => {
    const artistList = document.getElementById("artistList");
    const addArtistForm = document.getElementById("addArtistForm");

    function fetchArtists() {
        fetch("api/artists.php")
            .then(response => response.json())
            .then(data => {
                artistList.innerHTML = "";
                data.forEach(artist => {
                    const li = document.createElement("li");
                    li.textContent = `${artist.name} - ${artist.genre} - ${artist.contact_info}`;
                    artistList.appendChild(li);
                });
            })
            .catch(error => console.error("Error fetching artists:", error));
    }

    fetchArtists();

    addArtistForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const name = document.getElementById("name").value;
        const genre = document.getElementById("genre").value;
        const contact_info = document.getElementById("contact_info").value;

        fetch("api/artists.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ name, genre, contact_info })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                fetchArtists(); // Actualizează lista de artiști
                addArtistForm.reset();
            } else {
                console.error("Failed to add artist:", data.message);
            }
        })
        .catch(error => console.error("Error adding artist:", error));
    });
});
