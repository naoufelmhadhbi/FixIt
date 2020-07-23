import {Component, OnInit} from '@angular/core';
import {Publication} from '../../Model/Publication';
import {PublicationService} from '../../../Services/PublicationService/publication.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-demandes-encours',
  templateUrl: './demandes-encours.component.html',
  styleUrls: ['./demandes-encours.component.css']
})
export class DemandesEncoursComponent implements OnInit {

  private publications: Publication[] = [];
  displayedColumns: string[] = ['id', 'titre', 'detail', 'etat', 'username', 'action'];
  accepted = false;
  constructor(private publicationService: PublicationService, private router: Router) {
    this.publicationService.getPublicationParEtat('Still waiting for acceptation').subscribe((data) => {
      this.publications = data;
    });
  }

  ngOnInit() {
    //
    // console.log(this.publications);
    // this.publicationService.getAllPublication().subscribe((data) => {
    //   this.publications = data;
    // });
  }

  click() {
    // this.publicationService.getAllPublication().subscribe((data) => {
    //   this.publications = data;
    // });

    console.log(this.publications);
  }

  accepter(idPub, idProf) {
    this.publicationService.accepterPostule(idPub, idProf).subscribe((data) => {
      this.publications = data;
    });
    // this.router.navigateByUrl('/mesDemandesEncours', { skipLocationChange: true }).then(() => {
    //   this.router.navigate(['/mesDemandes']);
    // });
    location.reload();
    this.accepted = true;
  }


}
