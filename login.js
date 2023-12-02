window.addEventListener("load", function(){

    btn = document.querySelector(".sub_btn");
    result = document.querySelector(".result");

    btn.addEventListener("click",function(event){
        event.preventDefault();
        let url = `login.php`;
        console.log(url);

        fetch(url)
        .then(function (response) {
            if (response.ok) {
            return response.text();
            } else {
            throw new Error(response.statusText);
            }
        })
        .then(function (data) {
            result.innerHTML = data;
        });

    })

})