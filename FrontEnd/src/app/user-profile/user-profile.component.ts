import { Component, OnInit } from '@angular/core';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";

@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css']
})
export class UserProfileComponent implements OnInit {

  constructor(private authService: AuthentificationServiceService) { }
  username :string ;
  ngOnInit() {
    console.log('usernnnnnnnn' + this.authService.username)
    this.username = this.authService.username ;
  }

  test(){
    console.log('qqqqq' + this.authService.username);
  }

}
