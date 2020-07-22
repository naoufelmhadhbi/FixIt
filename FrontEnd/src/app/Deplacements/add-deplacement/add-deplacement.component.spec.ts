import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddDeplacementComponent } from './add-deplacement.component';

describe('AddDeplacementComponent', () => {
  let component: AddDeplacementComponent;
  let fixture: ComponentFixture<AddDeplacementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddDeplacementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddDeplacementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
