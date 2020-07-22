import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {User} from '../../Model/user/User';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-item-metier',
  templateUrl: './item-metier.component.html',
  styleUrls: ['./item-metier.component.css']
})
export class ItemMetierComponent implements OnInit {

  @Input() ListToItem: any;
  @Output() ItemToList = new EventEmitter();

  user: User = null;

  constructor(
    private portfolioservice: PortfolioService,
    private authService: AuthentificationServiceService,
    private router: Router
  ) {
  }

  ngOnInit() {
  }

  selected() {
    this.ItemToList.emit(
      this.ListToItem
    );
  }

  update(id) {
    console.log(id);
    const link = ['/UpdateMetier', id];
    this.router.navigate(link);
  }

  delete(id) {
    // console.log(id);
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      // console.log(this.user);
      this.DeleteMet(this.user.id, id);

    });
    this.router.navigateByUrl('/ListMetier', {skipLocationChange: true}).then(() => {
      this.router.navigate(['/metier']);
    });
  }

  DeleteMet(idProf, idMet) {
    this.portfolioservice.deleteMetier(idProf, idMet).subscribe(
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
