// 2. Runs when the JavaScript framework is loaded
function onLinkedInLoad() {
IN.Event.on(IN, "auth", onLinkedInAuth);
}

// 2. Runs when the viewer has authenticated
function onLinkedInAuth() {
IN.API.Profile("me").result(displayProfiles);
}

// 2. Runs when the Profile() API call returns successfully
function displayProfiles(profiles) {
member = profiles.values[0];
document.getElementById("profiles").innerHTML = 
  "<p id=\"" + member.id + "\">Hello " +  member.firstName + " " + member.lastName + "</p>";
}
  
var VM = {};

VM = new Core.ViewModel.SignUp();

VM.errors = ko.validation.group(VM);
// Initialize the knockout function
ko.applyBindings(VM);