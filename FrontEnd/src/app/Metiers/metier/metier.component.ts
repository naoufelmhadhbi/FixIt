import { Component, OnInit } from '@angular/core';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {Deplacement} from '../../Model/Deplacement';
import {User} from '../../Model/user/User';
import {Metier} from '../../Model/Metier';

@Component({
  selector: 'app-metier',
  templateUrl: './metier.component.html',
  styleUrls: ['./metier.component.css']
})
export class MetierComponent implements OnInit {

  constructor(
    private portfolioservice: PortfolioService,
    private authService: AuthentificationServiceService
  ) { }

  private metier: Metier[] = [];
  dispo: Metier;
  user: User = null;
  ngOnInit() {
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      // console.log(this.user);
      this.GetMetier(this.user.id);
    });
  }

  selectionner(dispo) {
    this.dispo = dispo;
  }

  GetMetier(id) {
    this.portfolioservice.getmetiers(id).subscribe((data1) => {
      this.metier = data1;

    });
  }

}
