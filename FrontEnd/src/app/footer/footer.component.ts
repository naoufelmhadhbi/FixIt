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

  invalidCredential: boolean;

  ngOnInit() {
  }

  onlogin(data) {
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
      console.log('erooor ' + error);
      this.invalidCredential = true ;
    }
  );

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
