import {Component, OnInit} from '@angular/core';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";
import {User} from "../Model/user/User";
import {Router} from "@angular/router";

@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css']
})
export class UserProfileComponent implements OnInit {

  constructor(private authService: AuthentificationServiceService , private router: Router) {
    debugger
    //if(localStorage.getItem('JwtToken') == null || localStorage.getItem('JwtToken') == undefined)
    //this.router.navigate(['/acceuil']);
  }

  username: string;
  user: User;

  ngOnInit() {
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
    })
  }

  isProfessionnel() {
    return this.user.type === 'professionnel' ;
  }

}
