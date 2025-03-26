document.getElementById("searchForm").addEventListener("submit", function (event) {
    event.preventDefault();
    let title = document.getElementById("movieTitle").value.trim();

    if (!title) {
        alert("Please enter a movie title!");
        return;
    }

    fetch(`search.php?title=${title}`)
        .then(response => response.json())
        .then(data => {
            let results = document.getElementById("movieResults");
            results.innerHTML = "";

            if (data.Response === "False") {
                results.innerHTML = `<p>No results found. Please try another title.</p>`;
                return;
            }

            data.Search.forEach(movie => {
                results.innerHTML += `
                    <div class="movie-card flex flex-col">
                        <img src="${movie.Poster !== "N/A" ? movie.Poster : 'placeholder.jpg'}"  class="h-full max-h-90">
                        <p class="text-xl py-2">${movie.Title} (${movie.Year})</p>
                        <form method="POST" action="add-favorites">
                            <input type="hidden" name="movie_id" value="${movie.imdbID}">
                            <input type="hidden" name="movie_title" value="${movie.Title}">
                            <input type="hidden" name="poster_url" value="${movie.Poster !== "N/A" ? movie.Poster : 'placeholder.jpg'}">
                            <button type="submit">Add to Favorites</button>
                        </form>
                    </div>
                `;
            });
        })
        .catch(error => {
            console.error("Error fetching movie data:", error);
            document.getElementById("movieResults").innerHTML = `<p>Something went wrong. Please try again later.</p>`;
        });
});
