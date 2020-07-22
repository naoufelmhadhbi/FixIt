import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {Router} from '@angular/router';
import {User} from '../../Model/user/User';

@Component({
  selector: 'app-item-deplacement',
  templateUrl: './item-deplacement.component.html',
  styleUrls: ['./item-deplacement.component.css']
})
export class ItemDeplacementComponent implements OnInit {

  @Input() ListToItem: any;
  @Output() ItemToList = new EventEmitter();

  user: User = null;

  constructor(private portfolioservice: PortfolioService,
              private authService: AuthentificationServiceService,
              private router: Router) {
  }

  ngOnInit() {
    console.log(this.ListToItem);
  }

  selected() {
    this.ItemToList.emit(
      this.ListToItem
    );
  }

  update(id) {
    console.log(id);
    const link = ['/UpdateDeplacement', id];
    this.router.navigate(link);
  }

  delete(id) {
    // console.log(id);
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      // console.log(this.user);
      this.DeleteDep(this.user.id, id);

    });
    this.router.navigateByUrl('/ListDeplacement', {skipLocationChange: true}).then(() => {
      this.router.navigate(['/deplacement']);
    });
  }

  DeleteDep(idProf, idDep) {
    this.portfolioservice.deleteDeplacement(idProf, idDep).subscribe(
      (response) => {
        // location.reload();
        //  this.PortToDetail = null;
        // this.router.navigate(['/portfolio']);

      },
      (error) => {
        console.log(error);
      }
    );
  }
}
