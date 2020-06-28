import { Component, OnInit } from '@angular/core';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

  constructor(private authService: AuthentificationServiceService) {
  }

  ngOnInit() {
    console.log('is   '+this.isAuthenticated());
  }

  isAuthenticated(){
    return this.authService.isAuthenticated();
  }

  logout(){
      this.authService.logout();
  }

}
