export interface Message {
  id : number ;
  idDemandeur : string ;
  idProfessionnel : string ;
  from : string ;
  vu : boolean ;
  message : string ;
  dateEnvoi: Date;

}
