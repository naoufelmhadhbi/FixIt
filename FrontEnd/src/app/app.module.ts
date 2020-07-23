import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { MessagerieComponent } from './messagerie/messagerie.component';
import { FooterComponent } from './footer/footer.component';
import { SliderComponent } from './slider/slider.component';
import {FormsModule, FormBuilder, ReactiveFormsModule} from '@angular/forms';
import {HttpClientModule} from '@angular/common/http';
import { UserProfileComponent } from './user-profile/user-profile.component';
import {RoutingModule} from './routing/routing.module';
import {APP_BASE_HREF} from '@angular/common';
import {RouterModule} from '@angular/router';
import { AccueilComponent } from './accueil/accueil.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MaterialModule } from './material/material.module';
import { UserInterfaceComponent } from './user-interface/user-interface.component';
import {PortfolioComponent} from './Portfolios/portfolio/portfolio.component';
import {ListImageComponent} from './Portfolios/list-image/list-image.component';
import {DetailImageComponent} from './Portfolios/detail-image/detail-image.component';
import {ItemImageComponent} from './Portfolios/item-image/item-image.component';
// import {MatCheckboxModule} from '@angular/material/typings/checkbox';
// import { FileSelectDirective } from 'ng2-file-upload';
import { AddImageComponent } from './Portfolios/add-image/add-image.component';
import { DeplacementComponent } from './Deplacements/deplacement/deplacement.component';
import { ListDeplacementComponent } from './Deplacements/list-deplacement/list-deplacement.component';
import { ItemDeplacementComponent } from './Deplacements/item-deplacement/item-deplacement.component';
import { AddDeplacementComponent } from './Deplacements/add-deplacement/add-deplacement.component';
import { UpdateImageComponent } from './Portfolios/update-image/update-image.component';
import { UpdateDeplacementComponent } from './Deplacements/update-deplacement/update-deplacement.component';
import { AddMetierComponent } from './Metiers/add-metier/add-metier.component';
import { MetierComponent } from './Metiers/metier/metier.component';
import { ItemMetierComponent } from './Metiers/item-metier/item-metier.component';
import { ListMetierComponent } from './Metiers/list-metier/list-metier.component';
import { UpdateMetierComponent } from './Metiers/update-metier/update-metier.component';
import { DemandesComponent } from './Publication/demandes/demandes.component';
import { DemandesEncoursComponent } from './Publication/demandes-encours/demandes-encours.component';
import { MesOffresComponent } from './Publication/mes-offres/mes-offres.component';
import { MesTraveauxComponent } from './Publication/mes-traveaux/mes-traveaux.component';
import {AddPublicationComponent} from './Publication/add-publication/add-publication.component';
import { CloturerProjetComponent } from './Publication/cloturer-projet/cloturer-projet.component';
import {ReclamationComponent} from './reclamation/reclamation.component';
import {CreateReclamationComponent} from './create-reclamation/create-reclamation.component';
import {UserReclamationComponent} from './user-reclamation/user-reclamation.component';
import {RepReclamationComponent} from './rep-reclamation/rep-reclamation.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    SliderComponent,
    UserProfileComponent,
    AddPublicationComponent,
    AccueilComponent,
    MessagerieComponent,
    UserInterfaceComponent,
    DemandesComponent,
    DemandesEncoursComponent,
    MesOffresComponent,
    MesTraveauxComponent,
    CloturerProjetComponent,
    PortfolioComponent,
    ListImageComponent,
    DetailImageComponent,
    ItemImageComponent,
    // FileSelectDirective,
    AddImageComponent,
    DeplacementComponent,
    ListDeplacementComponent,
    ItemDeplacementComponent,
    AddDeplacementComponent,
    UpdateImageComponent,
    UpdateDeplacementComponent,
    AddMetierComponent,
    MetierComponent,
    ItemMetierComponent,
    ListMetierComponent,
    UpdateMetierComponent,
    ReclamationComponent,
    CreateReclamationComponent,
    UserReclamationComponent,
    RepReclamationComponent,
    SliderComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    RoutingModule,
    RouterModule,
    BrowserAnimationsModule,
    MaterialModule,
    ReactiveFormsModule
  ],
  providers: [{provide: APP_BASE_HREF, useValue: '/'}],
  bootstrap: [AppComponent]
})
export class AppModule { }
