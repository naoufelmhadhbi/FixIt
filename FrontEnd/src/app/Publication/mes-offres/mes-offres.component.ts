import {Component, OnInit} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Publication} from '../../Model/Publication';
import {Observable} from 'rxjs';
import {PublicationService} from '../../../Services/PublicationService/publication.service';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-mes-offres',
  templateUrl: './mes-offres.component.html',
  styleUrls: ['./mes-offres.component.css']
})
export class MesOffresComponent implements OnInit {

  private publications: Publication[] = [];
  displayedColumns: string[] = ['id', 'titre', 'detail', 'etat', 'action'];
  accepted = false;
  constructor(private publicationService: PublicationService, private router: Router, private rout: ActivatedRoute) {

    this.publicationService.getPublicationParMetier().subscribe((data) => {
      this.publications = data;
    });
  }

  ngOnInit() {



    // console.log(this.publications);
  }

  click() {
    // this.publicationService.getPublicationParMetier().subscribe((data) => {
    //   this.publications = data;
    // });

    console.log(this.publications);
  }

  postuler(idPub) {
    this.publicationService.postuler(idPub).subscribe((data) => {
      this.publications = data;
    });
    // this.router.navigateByUrl('/mesOffres', { skipLocationChange: true }).then(() => {
    //   this.router.navigate(['/mesOffres']);
    // });
    this.accepted = true;
    location.reload();
  }


}
