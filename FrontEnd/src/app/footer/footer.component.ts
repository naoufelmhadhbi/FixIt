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
  emailExist: boolean = false ;
  showSpinner : boolean = false ;
  formRequiredError : boolean = false ;

  ngOnInit() {
  }

  onlogin(data) {
    debugger
    console.log('this data ' + data['username']);
    this.authService.login(data).subscribe(resp => {
      console.log('reps    ' + resp);
      if (resp['code'] != 401) {
         this.authService.saveToken(resp['token']);
         this.authService.saveIdUser(resp['username']);

       } else {
         this.invalidCredential = true ;
       }
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
    if(JSON.stringify(data).length < 194){
      console.log('number '+JSON.stringify(data).length)
      this.formRequiredError = true ;
      return ;
    }
    this.showSpinner = true ;
    this.authService.register(data).subscribe(resp =>{
      console.log('resp register is' + JSON.stringify(resp));
      console.log(resp['code']);
      if(resp['code'] == 401) {
        this.emailExist = true;
        this.showSpinner = false ;
        return ;
      }
      if(resp['code'] == 402) {
        this.usernameExist = true;
        this.showSpinner = false ;
        return ;
      }
      this.showSpinner = false ;
      document.getElementById('reset').click();
      document.getElementById('registersucces').click();
    });
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



}
