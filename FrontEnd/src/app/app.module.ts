import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';

import {AppComponent} from './app.component';
import {HeaderComponent} from './header/header.component';
import {MessagerieComponent} from './messagerie/messagerie.component';
import {FooterComponent} from './footer/footer.component';
import {SliderComponent} from './slider/slider.component';
import {PublicationsComponent} from './publications/publications.component';
import {FormsModule, FormBuilder, ReactiveFormsModule} from '@angular/forms';
import {HttpClientModule} from '@angular/common/http';
import {UserProfileComponent} from './user-profile/user-profile.component';
import {RoutingModule} from './routing/routing.module';
import {APP_BASE_HREF} from '@angular/common';
import {RouterModule} from '@angular/router';
import {AccueilComponent} from './accueil/accueil.component';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {MaterialModule} from './material/material.module';
import {UserInterfaceComponent} from './user-interface/user-interface.component';
import {PortfolioComponent} from './Portfolios/portfolio/portfolio.component';
import {ListImageComponent} from './Portfolios/list-image/list-image.component';
import {DetailImageComponent} from './Portfolios/detail-image/detail-image.component';
import {ItemImageComponent} from './Portfolios/item-image/item-image.component';
// import {MatCheckboxModule} from '@angular/material/typings/checkbox';
import { FileSelectDirective } from 'ng2-file-upload';
import { AddImageComponent } from './Portfolios/add-image/add-image.component';
import { DeplacementComponent } from './Deplacements/deplacement/deplacement.component';
import {MatCheckboxModule} from '@angular/material';
import { ListDeplacementComponent } from './Deplacements/list-deplacement/list-deplacement.component';
import { ItemDeplacementComponent } from './Deplacements/item-deplacement/item-deplacement.component';
import { ReclamationComponent } from './reclamation/reclamation.component';
import { AddDeplacementComponent } from './Deplacements/add-deplacement/add-deplacement.component';
import { UpdateImageComponent } from './Portfolios/update-image/update-image.component';
import { UpdateDeplacementComponent } from './Deplacements/update-deplacement/update-deplacement.component';
import { AddMetierComponent } from './Metiers/add-metier/add-metier.component';
import { MetierComponent } from './Metiers/metier/metier.component';
import { ItemMetierComponent } from './Metiers/item-metier/item-metier.component';
import { ListMetierComponent } from './Metiers/list-metier/list-metier.component';
import { UpdateMetierComponent } from './Metiers/update-metier/update-metier.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    SliderComponent,
    PublicationsComponent,
    UserProfileComponent,
    AccueilComponent,
    MessagerieComponent,
    UserInterfaceComponent,
    PortfolioComponent,
    ListImageComponent,
    DetailImageComponent,
    FileSelectDirective,
    ItemImageComponent,
    AddImageComponent,
    DeplacementComponent,
    ListDeplacementComponent,
    ItemDeplacementComponent,
    ReclamationComponent,
    AddDeplacementComponent,
    UpdateImageComponent,
    UpdateDeplacementComponent,
    AddMetierComponent,
    MetierComponent,
    ItemMetierComponent,
    ListMetierComponent,
    UpdateMetierComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    RouterModule,
    HttpClientModule,
    RoutingModule,
    RouterModule,
    BrowserAnimationsModule,
    MaterialModule,
    ReactiveFormsModule,
    MatCheckboxModule,
    // MatCheckboxModule

  ],
  providers: [{provide: APP_BASE_HREF, useValue: '/'}],
  bootstrap: [AppComponent]
})
export class AppModule {
}
