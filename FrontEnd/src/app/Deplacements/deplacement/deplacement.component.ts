import { Component, OnInit } from '@angular/core';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {Portfolio} from '../../Model/Portfolio';
import {User} from '../../Model/user/User';
import {Deplacement} from '../../Model/Deplacement';

@Component({
  selector: 'app-deplacement',
  templateUrl: './deplacement.component.html',
  styleUrls: ['./deplacement.component.css']
})
export class DeplacementComponent implements OnInit {

  constructor(
    private portfolioservice: PortfolioService,
    private authService: AuthentificationServiceService
  ) {
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      // console.log(this.user);
      this.GetDeplacement(this.user.id);
    });
  }

  private deplacement: Deplacement[] = [];
  dispo: Deplacement;
  user: User = null;

  ngOnInit() {

  }

  selectionner(dispo) {
    this.dispo = dispo;
  }

  GetDeplacement(id) {
    this.portfolioservice.getdeplacements(id).subscribe((data1) => {
      this.deplacement = data1;

    });
  }
}
