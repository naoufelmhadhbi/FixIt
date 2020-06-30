import {Component, OnInit} from '@angular/core';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";
import {Router} from "@angular/router";




@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.css']
})
export class FooterComponent implements OnInit {

  constructor(private authService: AuthentificationServiceService, private router: Router) {
  }

  invalidCredential: boolean ;
  isProfessionnel: boolean ;
  usernameExist: boolean = false ;
  emailExist: boolean ;

  ngOnInit() {
  }

  onlogin(data) {
    debugger
    console.log('this data ' + data['username']);
    this.authService.login(data).subscribe(resp => {
      console.log('reps    ' + resp);
       if(resp['code'] != 401)
         this.authService.saveToken(resp['token']);
      else
         this.invalidCredential = true ;
        console.log('USER AND MDP OK');
        document.getElementById('btnSave').click();
        this.router.navigate(['/userProfile']);
    },
    error => {
      console.log('erreur ' + JSON.stringify(error));
      this.invalidCredential = true ;
    }
  );

  }

  registration(data){
    debugger
    console.log('this data email' + data['email']);
    console.log('with json ' + JSON.stringify(data));
    console.log('before   ' + this.emailExist);
    this.usernameEmailExist(data['email'],data['username']);
    console.log('after   ' + this.emailExist);
    // if(this.usernameEmailExist(data['email'],data['username']) == 'email exist')
    //     this.emailExist = true ;
    // else if(this.usernameEmailExist(data['email'],data['username']) == 'username exist')
    //     this.usernameExist = true ;
    // else
    if(!this.emailExist && this.emailExist != undefined){
    this.authService.register(data).subscribe(resp =>{
      console.log('resp register is' + resp);
    },
    error => {
      console.log('erreur ' + JSON.stringify(error));
    });}
  }

  changeType(data){
    if(data == 'professionnel')
      this.isProfessionnel = true ;
    else
      this.isProfessionnel = false ;
  }

  isAdmin() {
    return this.authService.isAdmin();
  }

  isUser() {
    return this.authService.isUser();
  }

  isAuthenticated() {
    return this.authService.isAuthenticated();
  }

  redirect() {
    this.router.navigate(['/userProfile']);
  }

  usernameEmailExist(email,username){
    console.log('username fromn ' + email)
    this.authService.getAllUser().subscribe(resp => {
      console.log('--------------'+resp[0]['email']) ;
       for(var key in resp){
         console.log(resp[key]['email']);
         if(resp[key]['email'] == email){
           this.emailExist = true ;
           console.log('yyyyyyyyyyyyses')
         }
         else this.emailExist = false ;
      //   if(resp[key]['username'] == username)
      //     this.usernameExist = true ;
       }
    });
  }


}
