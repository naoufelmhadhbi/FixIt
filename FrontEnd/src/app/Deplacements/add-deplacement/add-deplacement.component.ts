import {Component, OnInit} from '@angular/core';
import {Deplacement} from '../../Model/Deplacement';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {Router} from '@angular/router';
import {User} from '../../Model/user/User';

@Component({
  selector: 'app-add-deplacement',
  templateUrl: './add-deplacement.component.html',
  styleUrls: ['./add-deplacement.component.css']
})
export class AddDeplacementComponent implements OnInit {

  private deplacement: Deplacement[];
  private deplac: Deplacement;
  user: User = null;
  constructor(private portfolioservice: PortfolioService,
              private authService: AuthentificationServiceService,
              private router: Router
  ) {
    this.deplac = {
      id : null,
      gouvernorat : '',
    };
  }

  ngOnInit() {
    this.portfolioservice.getAllDeplacements().subscribe((data) => {
      this.deplacement = data;

    });
  }

  changePlace(idPlace) {
    // let idPlace = event.target.value;
    console.log(idPlace);
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      // console.log(this.user);
      this.addDep(this.user.id, idPlace);
      this.router.navigate(['/deplacement']);

    });
  }

  addDep(idProf, idDep) {
    this.portfolioservice.addDeplacement(idProf, idDep).subscribe(
      (response) => {
      },
      (error) => {
        console.log(error);
      }
    );
  }


}
