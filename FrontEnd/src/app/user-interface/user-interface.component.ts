import { Component, OnInit } from '@angular/core';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";
import {User} from "../Model/user/User";
import {Router} from "@angular/router";
import {MessagerieService} from '../../Services/MessagerieService/messagerie.service';

@Component({
  selector: 'app-user-interface',
  templateUrl: './user-interface.component.html',
  styleUrls: ['./user-interface.component.css']
})
export class UserInterfaceComponent implements OnInit {
  userConnected : User ;
  isProfessionnel : boolean ;
  nbrvu : number ;
  constructor(private authService: AuthentificationServiceService , private router: Router,private messageService: MessagerieService) {
    if(localStorage.getItem('JwtToken') == null || localStorage.getItem('JwtToken') == undefined)
      this.router.navigate(['/accueil']);
   }

  ngOnInit() {
    debugger
    this.authService.getByUsr().subscribe((data) => {
      this.userConnected = data[0];
      this.isProfessionnel = this.userConnected.type == 'professionnel' ;
        this.messageService.getAllNbrVu(this.isProfessionnel,this.userConnected.id).subscribe(data => {
          console.log('data sw s '+data[0]['nbrvu']);
          this.nbrvu = data[0]['nbrvu'] ;
        })
    });
  }

  logout(){
    this.authService.logout();
  }

}
