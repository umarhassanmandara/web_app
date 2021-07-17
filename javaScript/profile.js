console.log('it works');
const profileName = document.querySelector('.profile-name');
const profileAddress = document.querySelector('.profile-address');
const profileEmail = document.querySelector('.icon-envelope');
const profilePhone = document.querySelector('.icon-phone');
const profileImage = document.querySelector('.profile-img');
const photo = document.querySelector('[name="image"]');
const uploadBtn = document.querySelector('.upload-btn');
const logoutButton = document.querySelector('.logout1');
const myForm = document.querySelector('.myForm');
const postBox = document.querySelector('.post-box')
const allPost = document.querySelector('.all-post')
var fragment = document.createDocumentFragment();



console.log(logoutButton);


fetch('includes/view-all-post.inc.php',{
    method: 'GET',
   
 }).then(function(response) {
     return response.json();
 }).then(function (text) {
     console.log(text);
    
 }).catch(function (error) {
     console.log(error);
 });


function inserDom(user) {
    profileName.textContent = user.first_name;
    profilePhone.textContent = user.phone;
    profileEmail.textContent = user.email;
    profileAddress.textContent = user.address;
    profileImage.src = `includes/${user.photo}`;
}

function initialFetch(){

fetch('includes/view-single-user.php',{
    method: 'GET',
   
 }).then(function(response) {
     return response.json();
 }).then(function (text) {
     console.log(text);
     inserDom(text[0]);
    
 }).catch(function (error) {
     console.log(error);
 });

}

initialFetch();

    uploadBtn.addEventListener('click',function (e) {
        e.preventDefault();

        console.log(photo.files);
    
        const formData = new FormData();
        formData.append('image', photo.files[0])
    
        fetch('./includes/upload-photo.inc.php',{
           method: 'post',
          body: formData  
        }).then(function(response) {
            initialFetch();
            return response.json();
        }).then(function (file) {
            console.log(file);
        }).catch(function (error) {
            console.log(error);
        })
    });   

    logoutButton.addEventListener('click', (e)=>{
        e.preventDefault();

        // console.log('hello');
        fetch('./includes/logout.inc.php',{
            method: 'get',
         }).then(function(response) {
             return response.json();
         }).then(function (text) {
             console.log(text);
             if(text.status == 1) window.location = 'login.html';
         }).catch(function (error) {
             console.log(error);
         })
       
    });

    myForm.addEventListener('submit',function (e) {
        e.preventDefault();
    
        const formData = new FormData(this);
    
        fetch('./includes/addpost.inc.php',{
           method: 'post',
          body: formData  
        }).then(function(response) {
            return response.json();
        }).then(function (text) {
            console.log(text);
            text[0].map((post,ind) => {

                const content = document.createElement('p')
                const userName = document.createElement('p')

                content.textContent = post.post
                content.classList.add('single-post')

                userName.textContent = post.first_name
                userName.classList.add('author')

                fragment.appendChild(content)
                fragment.appendChild(userName)
                allPost.appendChild(fragment)

                content.addEventListener('click', () => {
                    console.log(ind + 1)
                    localStorage.removeItem('postId')
                    localStorage.setItem('postId', ind+1)
                    // window.location.href = 'post-detail'
                  })
            })
        })
        .catch(function (error) {
            console.log(error);
        })
    });
