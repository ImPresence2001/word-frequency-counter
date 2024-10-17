<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
    <h1>Word Frequency Counter</h1>
    
    <form id="wordForm">
        <label for="text">Paste your text here:</label>
        <textarea id="text" name="text" required placeholder=" "></textarea>
        
        <label for="sort">Sort by frequency:</label>
        <select id="sort" name="sort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
        
        <label for="limit">Number of words to display:</label>
        <input type="number" id="limit" name="limit" value="10" min="1">
        
        <input type="submit" id="button" value="Calculate Word Frequency">
    </form>

    <div id="resultsContainer" class="results" style="display:none;">
        <h2>Results:</h2>
        <ol id="resultsList"></ol>
    </div>

    <script>
        document.getElementById('wordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('func.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {

                const resultsList = document.getElementById('resultsList');
                resultsList.innerHTML = '';

                data.forEach(result => {
                    const li = document.createElement('li');
                    li.textContent = result;
                    resultsList.appendChild(li);
                });

                document.getElementById('resultsContainer').style.display = 'block';
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
