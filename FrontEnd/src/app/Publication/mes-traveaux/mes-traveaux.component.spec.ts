import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MesTraveauxComponent } from './mes-traveaux.component';

describe('MesTraveauxComponent', () => {
  let component: MesTraveauxComponent;
  let fixture: ComponentFixture<MesTraveauxComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MesTraveauxComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MesTraveauxComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
