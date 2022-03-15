var chartData = {
  type: 'bar',
//   'scroll-x': {

//   },
//   'scroll-y': {

//   },
//   refresh : {
//     "type" : "full",
//     "interval" : 10
//   },
//   plotarea: {
//     'adjust-layout': true
//   },
  'scale-x': {
    // zooming: true,
    label: { /* Scale Title */
      text: "Days of the Week",
    },
    labels: [ "Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"] /* Scale Labels */ 
  },
//   'crosshair-x': {
//     'plot-label': {
//       text: "%v"
//     },
//     'scale-label': {
//       visible: false
//     }
//   },
//   'crosshair-y': {
//     type: "multiple",
//     'scale-label': {
//       visible: false
//     }
//   },
  series: [
    { values: values}
  ]
};

// zingchart.TOUCHZOOM = 'pinch';

zingchart.render({
  id: 'myChart',
  data: chartData,
  height: 400,
  width: '100%'
});


// const signUp = (email, password) => {

//   firebase.auth().createUserWithEmailAndPassword(email, password).catch(function(error) {
//     // Handle Errors here.
//     var errorCode = error.code;
//     var errorMessage = error.message;
//     console.log(error.message);
//     // ...
//   });

// }

// const signIn = (email, password) => {
//   firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
//     // Handle Errors here.
//     var errorCode = error.code;
//     var errorMessage = error.message;
//     alert(error.message);
//     // ...
//   });
// }

// const signOut = () => {
//   firebase.auth().signOut();
// }

// firebase.auth().onAuthStateChanged(function(user) {
//   if (user) {
//     // User is signed in.
//     var displayName = user.displayName;
//     var email = user.email;
//     currentUser = user;
//     window.location.replace("./dashboard.php");
//     logOut.innerHTML = "Sign Out";
//     // ...
//   } else {
//     // User is signed out.
//     delete currentUser.email;
//     window.location.replace("./sign-in.html");
//     // ...
//   }
// });

// submitBtn[0].addEventListener("click",function (){
//   let email = document.getElementById("inputEmail").value;
//   let password = document.getElementById("inputPassword").value;
    
//   console.log("Existing User:" + email + "," + password);
//   signIn(email, password)
//   console.log(email + " has just logged in");
// });

// logOut.addEventListener("click", function (){
//   signOut();
//   logOut.innerHTML = "Sign in"
//   window.location("./sign-in.html")
// })