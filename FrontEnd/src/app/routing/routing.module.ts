import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {UserProfileComponent} from '../user-profile/user-profile.component';
import {UserInterfaceComponent} from '../user-interface/user-interface.component';
import {MessagerieComponent} from '../messagerie/messagerie.component';
import {RouterModule, Routes} from '@angular/router';
import {AccueilComponent} from '../accueil/accueil.component';
import {DemandesComponent} from '../Publication/demandes/demandes.component';
import {DemandesEncoursComponent} from '../Publication/demandes-encours/demandes-encours.component';
import {MesOffresComponent} from '../Publication/mes-offres/mes-offres.component';
import {MesTraveauxComponent} from '../Publication/mes-traveaux/mes-traveaux.component';
import {AddPublicationComponent} from '../Publication/add-publication/add-publication.component';
import {CloturerProjetComponent} from '../Publication/cloturer-projet/cloturer-projet.component';

const routes: Routes = [
  {
    path: '', component: UserInterfaceComponent,
    children: [
      {path: 'messagerie', component: MessagerieComponent},
      {path: 'userProfile', component: UserProfileComponent},
      {path: 'mesDemandes', component: DemandesComponent},
      {path: 'mesDemandesEncours', component: DemandesEncoursComponent},
      {path: 'mesOffres', component: MesOffresComponent},
      {path: 'mesTraveaux', component: MesTraveauxComponent},
      {path: 'mesTraveaux', component: MesTraveauxComponent},
      {path: 'AddPublication', component: AddPublicationComponent},
      {path: 'cloturerProjet', component: CloturerProjetComponent},

    ]
  },
  {path: 'accueil', component: AccueilComponent}
];

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    RouterModule.forRoot(routes)
  ]
})
export class RoutingModule {
}
