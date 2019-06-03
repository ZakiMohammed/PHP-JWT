$(function () { 

    let loginLink = `<a class="nav-link" href="login.html">Login</a>`;
    let profileLink = ``;
    let storage = localStorage.getItem('php_jwt');
    if (storage) {
        loginLink = `<a class="nav-link" href="javascript:void(0);" onclick="logout();">Logout</a>`;
        profileLink = `<li class="nav-item"><a class="nav-link" href="profile.html">Profile</a></li>`
    }
    
    $('#header').html(`
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="index.html">PHP JWT</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>        
                    </li>
                    ${profileLink}                    
                    <li class="nav-item">
                        ${loginLink}
                    </li>
                </ul>      
            </div>
        </nav>`);

 });

 function logout() {
    localStorage.removeItem('php_jwt');
    window.location = 'index.html';
 }