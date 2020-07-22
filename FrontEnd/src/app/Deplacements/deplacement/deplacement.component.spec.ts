import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DeplacementComponent } from './deplacement.component';

describe('DeplacementComponent', () => {
  let component: DeplacementComponent;
  let fixture: ComponentFixture<DeplacementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DeplacementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DeplacementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
