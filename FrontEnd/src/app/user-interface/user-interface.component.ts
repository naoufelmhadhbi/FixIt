import { Component, OnInit } from '@angular/core';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";
import {User} from "../Model/user/User";
import {Router} from "@angular/router";

@Component({
  selector: 'app-user-interface',
  templateUrl: './user-interface.component.html',
  styleUrls: ['./user-interface.component.css']
})
export class UserInterfaceComponent implements OnInit {
  userConnected : User ;
  constructor(private authService: AuthentificationServiceService , private router: Router) {
    //if(localStorage.getItem('JwtToken') == null || localStorage.getItem('JwtToken') == undefined)
      //this.router.navigate(['/acceuil']);
   }

  ngOnInit() {
    this.authService.getByUsr().subscribe((data) => {
      this.userConnected = data[0];
    });
  }

}
