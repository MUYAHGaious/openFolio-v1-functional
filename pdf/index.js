function fetchUsers(){
    
    var results = fetch('http://localhost:8080/openFolio-v1-functional/oop/classes/skills.php')
    .then(response => response.json())
    .catch(error => console.error(error));

    console.log(results);
    return results;
}